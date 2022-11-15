<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VisitorType;
use App\Models\AuthorisationStatus;
use App\Models\Visits;
use App\Models\Communities;
use App\Models\Streets;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $residents = [];
        $id = Auth::user()->id;
        $visits = Visits::getResidentCurrentDayVisits($id);
        $visitorTypes = VisitorType::all(['id', 'name']);
        $communities = Communities::all(['id', 'name']);
        $addresses = Streets::all(['id', 'name']);
        $authorisationStatuses = AuthorisationStatus::all(['id', 'name']);


        if(Auth::user()->hasRole('RESIDENT')){

            $id = Auth::user()->id;
            $visits = Visits::getResidentCurrentDayVisits($id);

            return view('residentdashboard',[
                                        'visits' => $visits,
                                        'visitorTypes' => $visitorTypes,
                                        'authorisationStatus' => $authorisationStatuses,
                                 
                                    ]);
        } elseif (Auth::user()->hasRole('SECURITY')) {


            if ($request->has('name_resident')) {
                $userName = $request->input('name_resident');
                $address = $request->input('address');
            } else {
                $userName = [];
            }
            if ($userName) {
                $residents = User::getResident($userName);
                Log::info($userName);
            } elseif (isset($address)) {
                $residents = User::getResidentByAddress($address);
            }
            
            return view('securitydashboard', [
                'residents' => $residents,
                'visits' => $visits,
                'visitorTypes' => $visitorTypes,
                'authorisationStatus' => $authorisationStatuses,
                'addresses' => $addresses,
                'communities' => $communities,
            ])->with('status','THIS IS A RESIDENT');
        } elseif (Auth::user()->hasRole('ADMINISTRATOR')) {
            $role = Auth::user()->getRoles()[0];
            return view('dashboard',['role' => $role]);
        }
    }


    public function store(Request $request)
    {
        $userRole = 1;
        $id = Auth::user()->id;
        $visits = Visits::getResidentCurrentDayVisits($id);
        $visitorTypes = VisitorType::all(['id', 'name']);
        $authorisationStatuses = AuthorisationStatus::all(['id', 'name']);
        if (Auth::user()->hasRole('RESIDENT')) {

            $visits = Visits::create([

                'id_user' => Auth::user()->id,
                'name_visitor' => $request->input('name_visitor'),
                'visitor_type' => $request->input('visitor_type'),
                'status_authorisation' => $request->input('status_authorisation'),
                'license_plate' => $request->input('license_plate'),
                'created_by' => Auth::user()->id
            ]);

            return redirect()->route('dashboard', [
                'visits' => $visits,
                'visitorTypes' => $visitorTypes,
                'authorisationStatus' => $authorisationStatuses,
            ])->with('status','Visits Successfully updated');
        } elseif (Auth::user()->hasRole('SECURITY')) {

            $visits = Visits::create([

                'id_user' => $request->input('id_user'),
                'name_visitor' => $request->input('name_visitor'),
                'visitor_type' => $request->input('visitor_type'),
                'status_authorisation' => $request->input('status_authorisation'),
                'license_plate' => $request->input('license_plate'),
                'created_by' => Auth::user()->id
            ]);

            return redirect()->route('dashboard', [
                'visits' => $visits,
                'visitorTypes' => $visitorTypes,
                'authorisationStatus' => $authorisationStatuses,
            ])->with('status','Visits Successfully updated');
        } elseif (Auth::user()->hasRole('ADMINISTRATOR')) {
            return view('resident.create');
        };
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $visits = Visits::find($id);
        $visitorTypes = VisitorType::all(['id', 'name']);
        $authorisationStatuses = AuthorisationStatus::all(['id', 'name']);

        $visitorname = $request->input('visitorname');
        $visitorType = $request->input('visitorType');
        $status_authorisation = $request->input('authorisationStatus');
        $license_plate = $request->input('licensePlate');
        return view('residentdashboardedit', [
            'visitorname' => $visitorname,
            'visitorType' => $visitorType,
            'statusAuthorisation' => $status_authorisation,
            'licensePlate' => $license_plate,
            'visits' => $visits,
            'visitorTypes' => $visitorTypes,
            'authorisationStatus' => $authorisationStatuses,

        ]);
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
        $visits = Visits::find($id);
        $visits->name_visitor = $request->input('name_visitor');
        $visits->visitor_type = $request->input('visitor_type');
        $visits->status_authorisation = $request->input('status_authorisation');
        $visits->license_plate = $request->input('license_plate');

        $visits->save();

        return redirect()->route('dashboard');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Visits::destroy($id);

        return redirect()->route("dashboard");
    }

    public function myprofile()
    {
        return view('myprofile');
    }

    public function postcreate()


    {
        return view('postcreate');
    }
}
