<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class ApiInventoryController extends Controller
{
    public function getInventory(Request $request)
    {
        $data = Inventory::where('provider_id', $request->provider_id)->paginate(4);
        return response()->json($data, 200);
    }
}
