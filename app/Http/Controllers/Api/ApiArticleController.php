<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ApiArticleController extends Controller
{
    public function getArticle(Request $request)
    {
        $data = Article::when(request('filter') == 'latest', function ($q) {
            return $q->orderBy('created_at', 'desc');
        })->paginate(9);
        return response()->json($data, 200);
    }
}
