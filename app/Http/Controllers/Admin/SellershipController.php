<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sellership;
use Illuminate\Http\Request;

class SellershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sellership  $sellership
     * @return \Illuminate\Http\Response
     */
    public function edit(Sellership $sellership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sellership  $sellership
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sellership $sellership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sellership  $sellership
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sellership $sellership)
    {
        //
    }
}
