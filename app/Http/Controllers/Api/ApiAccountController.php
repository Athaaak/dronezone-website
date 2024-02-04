<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ApiAccountController extends Controller
{
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('users.id', 'users.email', 'users.created_at', 'providers.company_name', 'providers.id as provider_id', 'providers.user_id')->leftJoin('providers', 'providers.user_id', '=', 'users.id')
                ->where('role', 'provider')
                ->where('providers.deleted_at', null)
                ->latest();

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $action = '';

                    if ($data->provider == null) {
                        $action = '<a href="' . route('accounts.index') . '?user_id=' . $data->id . '" class="btn btn-success my-2">Account</a>';
                    } else {
                        $action = '<a href="' . route('accounts.index') . '?provider_id=' . $data->provider_id . '" class="btn btn-success my-2">Account</a>';
                    }
                    return '
                    <td>
                        <div class="d-flex flex-column">
                            ' . $action . '
                        </div>
                    </td>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
