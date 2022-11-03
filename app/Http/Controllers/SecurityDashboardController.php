<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VisitorType;
use App\Models\AuthorisationStatus;
use App\Models\Visits;
use App\Models\Addresses;
use App\Models\Communities;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class SecurityDashboardController extends Controller
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

    public function residentEntry(Request $request)
    {
        //dd($request);
        $residents = [];

        if ($request->has('name_resident')) {
            $userName = $request->input('name_resident');
            $address = $request->input('address');
        } else {
            $userName = [];
        }
        if ($userName) {
            $residents = User::getResident($userName);
            dd($residents);
        } elseif (isset($address)) {
            $residents = User::getResidentByAddress($address);
        }

        return view('residentEntry', [
            'residents' => $residents
        ])->with('status','THIS IS A RESIDENT');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
