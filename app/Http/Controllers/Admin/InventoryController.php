<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Provider;
use App\Services\ImageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function __construct(
        public ImageServices $imageServices,
        //public services
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user()->role != 'provider') {
            $provider_id = $request->provider_id;

            if ($provider_id == null) {
                return view('admin.inventory.index');
            }

            $provider = Provider::with(['user'])->where('id', $provider_id)->first();

            return view('admin.inventory.detail', compact('provider'));
        }

        $auth = Auth::user();
        $provider = Provider::with(['user'])->where('user_id', $auth->id)->first();

        return view('admin.inventory.detail');
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
        $provider_id = "";
        if (Auth::user()->role != 'provider') {
            $provider_id = $request->provider_id;
        } else {
            $auth = Auth::user();
            $provider = Provider::with(['user'])->where('user_id', $auth->id)->first();
            $provider_id = $provider->id;
        }


        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'spesification' => 'required',
            'detail_inventory' => 'required',
            'special_feature' => 'required',
            'image' => 'required'
        ]);

        Inventory::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'spesification' => $request->input('spesification'),
            'detail_inventory' => $request->input('detail_inventory'),
            'special_feature' => $request->input('special_feature'),
            'provider_id' => $provider_id,
            'photo' => $this->imageServices->uploadImage($request->file('image')),
        ]);

        return response()->json(['message' => 'Inventory was successfuly added!']);
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
        $portfolio = DB::table('inventories')->where('id', $id)->first();

        $db = DB::table('inventories')->where('id', $id);
        $db->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'spesification' => $request->input('spesification'),
            'detail_inventory' => $request->input('detail_inventory'),
            'special_feature' => $request->input('special_feature'),
            'photo' => $request->file('image') != null ? $this->imageServices->uploadImage($request->file('image')) : $portfolio->photo,
        ]);

        return response()->json(['message' => 'Inventory was successfuly updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $db = Inventory::find($id);
        $db->delete();

        return response()->json(['message' => 'Inventory was successfuly deleted!']);
    }
}
