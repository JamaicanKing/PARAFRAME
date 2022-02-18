<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Addresses;
use App\Models\Communities;
use Faker\Provider\ar_JO\Address;  //<-----wah this???

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Addresses = Addresses::all();

        return view('address.index',['Addresses' => $Addresses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Communities = Communities::all(['id','name']);

        return view('address.create', ['Communities' => $Communities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $address = Addresses::create([
            
            'id_communities' => $request->input('id_communities'),
            'name' => $request->input('name'),
        ]);

        return redirect()->route('address.index');
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
        $address = Addresses::find($id);
        $Communities = Communities::all(['id','name']);

        return view('address.edit',['address' => $address, 
                                    'Communities' => $Communities]);
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
        $address = Addresses::find($id);
        $address->name = $request->input('name');
        $address->id_communities = $request->input('id_communities');
        $address->save();

        return redirect()->route('address.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Addresses::destroy($id);

        return redirect()->route("address.index");
    }
}
