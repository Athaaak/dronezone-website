<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class ApiProviderController extends Controller
{
    public function getProvider(Request $request)
    {
        $data = Provider::when($request->district != null, function ($query) use ($request) {
            $query->where('district', $request->district);
        })->when($request->division != null, function ($query) use ($request) {
            $query->where('division', $request->division);
        })->when($request->search != '', function ($query) use ($request) {
            $query->where('company_name', 'LIKE', '%' . $request->search . '%');
        })->paginate(4);

        return response()->json($data, 200);
    }
}
