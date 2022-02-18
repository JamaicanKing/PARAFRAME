<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuthorisationStatus;

class AuthorisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authorisationStatus = AuthorisationStatus::all();

        return view('authorisationStatus.index',['authorisationStatus' => $authorisationStatus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authorisationStatus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authorisationStatus = AuthorisationStatus::create([
            
            'name' => $request->input('name'),
        ]);

        return redirect()->route('authorisationStatus.index');
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
        $authorisationStatus = AuthorisationStatus::find($id);

        return view('authorisationStatus.edit',['authorisationStatus' => $authorisationStatus]);
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
        $authorisationStatus = AuthorisationStatus::find($id);
        $authorisationStatus->name = $request->input('name');

        $authorisationStatus->save();

        return redirect()->route('authorisationStatus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AuthorisationStatus::destroy($id);

        return redirect()->route("authorisationStatus.index");
    }
}
