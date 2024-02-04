<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Provider;
use App\Models\User;
use App\Services\ImageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->role != 'provider') {
            $provider_id = $request->provider_id;
            $user_id = $request->user_id;

            if ($provider_id == null && $user_id == null) {
                return view('admin.account.index');
            }

            $provider = null;

            if ($user_id != null) {
                $provider = Provider::with(['user'])->where('user_id', $user_id)->first();
            } else {
                $provider = Provider::with(['user'])->where('id', $provider_id)->first();
            }

            return view('admin.account.detail', compact('provider'));
        }

        $auth = Auth::user();
        $provider = Provider::with(['user'])->where('user_id', $auth->id)->first();

        return view('admin.account.detail', compact('provider'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Inventory::find($id);

        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $db = Provider::find($id);
            $db->delete();

            if (Auth::user()->id == $db->user_id) {
                Auth::logout();

                return response()->json(['message' => 'Provider was successfuly deleted! This account will be logout automatically', 'code' => 'provider_remove_self']);
            } else {
                return response()->json(['message' => 'Provider was successfuly deleted!', 'code' => 'admin_remove_provider']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => $th->getMessage()]);
        }
    }
}
