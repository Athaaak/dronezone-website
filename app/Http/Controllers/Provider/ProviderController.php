<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\User;
use App\Services\ImageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderController extends Controller
{
    public function __construct(
        public ImageServices $imageServices,
    ) {
    }

    public function index(Request $request)
    {
        if (Auth::user()->role != 'provider') {
            $user_id = $request->id;
            $user = User::with(['provider'])->where('id', $user_id)->first();

            return view('provider.dashboard.edit', compact('user'));
        }

        $user = Auth::user();

        $user = User::with(['provider'])->where('id', $user->id)->first();

        return view('provider.dashboard.edit', compact('user'));
    }

    public function update(Request $request, Provider $provider)
    {
        if ($request->id == null) {
            Provider::create([
                'contact' => $request->contact,
                'company_name' => $request->company_name,
                'provider_email' => $request->email,
                'division' => $request->division,
                'description' => $request->description,
                'address_provider' => $request->address,
                'phone_number' => $request->phone_number,
                'district' => $request->district,
                'user_id' => Auth::user()->id,
                'photo' => $request->photo != null ? $this->imageServices->uploadImage($request->file('photo')) : $provider->photo,
            ]);
        } else {
            Provider::find($request->id)
                ->update([
                    'contact' => $request->contact,
                    'provider_email' => $request->email,
                    'division' => $request->division,
                    'description' => $request->description,
                    'address_provider' => $request->address,
                    'district' => $request->district,
                    'photo' => $request->photo != null ? $this->imageServices->uploadImage($request->file('photo')) : $provider->photo,
                ]);
        }

        return response()->json(['message' => 'Provider successfully updated']);
    }
}
