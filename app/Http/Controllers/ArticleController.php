<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Services\ImageServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    public function __construct(
        public ImageServices $imageServices,
        //public services
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.articles.index');
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        Article::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'slug' => Str::slug($request->input('title')),
            'admin_id' => Auth::user()->id,
            'image' => $this->imageServices->uploadImage($request->file('image')),
        ]);

        return response()->json(['message' => 'Article was successfuly added!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return response()->json([
            'data' => $article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return response()->json([
            'data' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $article->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'slug' => Str::slug($request->input('title')),
            'image' => $request->file('image') != null ? $this->imageServices->uploadImage($request->file('image')) : $article->image,
        ]);

        return response()->json(['message' => 'Article was successfuly updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($article)
    {
        Article::find($article)->delete();

        return response()->json(['message' => 'Article was successfuly deleted!']);
    }
}
