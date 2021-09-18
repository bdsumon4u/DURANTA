<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddressController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $type)
    {
        if (!$address = $request->user()->addresses()->where('type', $type)->first()) {
            $address = [
                'name' => $request->user()->name,
                'type' => $type,
                'phone' => $request->user()->phone,
                'division' => '',
                'district' => '',
                'town' => '',
                'address' => '',
            ];
        }
        if ($request->isMethod('GET')) {
            return Inertia::render('Profile/AddressManager', compact('address'));
        }
        $request->user()->addresses()->updateOrCreate(compact('type'), $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|digits:11',
            'division' => 'required',
            'district' => 'required',
            'town' => 'required',
            'address' => 'required',
        ]));
        return redirect()->route('dashboard')->banner('Address Is Added.');
    }
}
