<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Provider;
use App\Models\User;
use App\Services\ImageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
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
                return view('admin.portfolio.index');
            }
            $provider = Provider::with(['user'])->where('id', $provider_id)->first();

            return view('admin.portfolio.detail', compact('provider'));
        }

        $auth = Auth::user();
        $provider = Provider::with(['user'])->where('user_id', $auth->id)->first();

        return view('admin.portfolio.detail');
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
            'image' => 'required',
            'video_url' => 'required'
        ]);

        Portfolio::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'video_url' => $request->input('video_url'),
            'provider_id' => $provider_id,
            'photo' => $this->imageServices->uploadImage($request->file('image')),
        ]);

        return response()->json(['message' => 'Article was successfuly added!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Portfolio::find($id);

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
        $portfolio = DB::table('portfolios')->where('id', $id)->first();

        $db = DB::table('portfolios')->where('id', $id);
        $db->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'video_url' => $request->input('video_url'),
            'photo' => $request->file('image') != null ? $this->imageServices->uploadImage($request->file('image')) : $portfolio->photo,
        ]);

        return response()->json(['message' => 'Portfolio was successfuly updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $db = Portfolio::find($id);
        $db->delete();

        return response()->json(['message' => 'Portfolio was successfuly deleted!']);
    }
}
