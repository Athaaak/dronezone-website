<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class ApiPortfolioController extends Controller
{
    public function getPortfolio(Request $request)
    {
        $data = Portfolio::where('provider_id', $request->provider_id)->paginate(4);
        return response()->json($data, 200);
    }
}
