<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('users.id', 'users.email', 'users.created_at', 'providers.company_name', 'providers.district', 'users.role')->leftJoin('providers', 'providers.user_id', '=', 'users.id')
                ->where('role', 'provider')
                ->where('district', 'LIKE', '%' . $request->district . '%')
                ->latest();

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '
                    <td>
                        <div class="d-flex flex-column">
                            <a href="' . route('dashboard.edit', $data->id) . '" class="btn btn-success my-2">Setting</a>
                        </div>
                    </td>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.dashboard.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with(['provider' => ['portfolio', 'inventory']])->where('id', $id)->first();

        return view('company.dashboard', compact('user'));
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
        //
    }
}
