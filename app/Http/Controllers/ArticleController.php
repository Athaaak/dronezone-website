<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Services\ImageServices;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function __construct(
        public ImageServices $imageServices,
        //public services
    ){

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        // $article = new Article();
        // $article->title=$request->input('title');
        // $article->save(); //cara lama

        Article::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'slug' => Str::slug($request->input('title')),
            'image' => $this->imageServices->uploadImage($request->file('image')),
        ]);
        return response()->json(['message'=>'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('article', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {

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
            'image' => $request->file('image')!=null ? $this->imageServices->uploadImage($request->file('image')):$article->image,
        ]);
        return response()->json(['message'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(['message'=>'success']);
    }
}
