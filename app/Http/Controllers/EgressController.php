<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visits;
use App\Models\Communities;
use App\Models\VisitorType;
use App\Models\Addresses;
use App\Models\AuthorisationStatus;
use App\Models\Avatar;
use Illuminate\Support\Facades\Log;
use App\Models\VehicleColors;
use App\Models\Vehicle;
use App\Models\VehicleTypes;
use App\Models\Entry;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Egress;
use App\Models\ResidentDetail;
use Illuminate\Support\Facades\Hash;


class EgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if (Auth::user()->hasRole('SECURITY')) {
            $name = $request->input('name');
            $licensePlate = $request->input('license_plate');

            $type = $request->input('type', false);
            if($type){
                $id = $request->input('id', false);
                if($id){
                    $visitorTypes = VisitorType::all(['id', 'name']);
                    $vehicle = Vehicle::all(['id', 'name']);
                    $vehicleTypes = VehicleTypes::all(['id', 'name']);
                    $vehicleColors = VehicleColors::all(['id', 'name']);
                    $authorisationStatuses = AuthorisationStatus::all(['id', 'name']);
                    $communities = Communities::all(['id', 'name']);
                    $addresses = Addresses::all(['id', 'name']);

                    $visit = Egress::getVisitByVisitID($id);
                    if($type == 'visitor'){
                        //dd($visit);
                        return view(
                            'visitorExit',
                            [
                                'visit' => $visit,
                                'visitorTypes' => $visitorTypes,
                                'authorisationStatus' => $authorisationStatuses,
                                'addresses' => $addresses,
                                'communities' => $communities,
                                'vehicle' => $vehicle,
                                'vehicleTypes' => $vehicleTypes,
                                'vehicleColors' => $vehicleColors

                            ]
                        );
                    }
                    elseif($type == 'resident') {
                        $resident = User::find($id);
                        $avatar = Avatar::find($id);
                        //dd($resident);
                        return view('pinConfirmation', ['resident' => $resident, 'avatar' => $avatar]);
                    }
                }
            }
            
            if(isset($name)){
                $visits = Egress::getVisitByVisitorName($name);
                $resident = User::getResident($name);
                //dd($visits);
            }
            elseif(isset($licensePlate)) {
                $visits = Egress::getVisitByVisitorName($licensePlate);
                $resident = User::getResidentByLicensePlate($licensePlate);
            }
            else {
                return view('exit')->with('status', 'Please enter a name or license plate number');
            }
            //dd($resident->isNotEmpty());
            return view('exit', ['visitors' => $visits, 'residents' => $resident]);

            if (isset($name)) {
                $visits = Egress::getVisitByVisitorName($name);
                $resident = User::getResident($name);
                //dd($visits->count());
                if ($visits->isNotEmpty()) {
                    Log::info('Visitor View returned');
                    return view(
                        'visitorExit',
                        [
                            'visits' => $visits,
                            'visitorTypes' => $visitorTypes,
                            'authorisationStatus' => $authorisationStatuses,
                            'addresses' => $addresses,
                            'communities' => $communities,
                            'vehicle' => $vehicle,
                            'vehicleTypes' => $vehicleTypes,
                            'vehicleColors' => $vehicleColors

                        ]
                    );
                } elseif ($resident->isNotEmpty()) {

                    return view(
                        'residentExit',
                        [
                            'resident' => $resident,
                            'visitorTypes' => $visitorTypes,
                            'authorisationStatus' => $authorisationStatuses,
                            'addresses' => $addresses,
                            'communities' => $communities,
                            'vehicle' => $vehicle,
                            'vehicleTypes' => $vehicleTypes,
                            'vehicleColors' => $vehicleColors

                        ]
                    );
                }
            } elseif (isset($licensePlate)) {

                $visits = Egress::getVisitByLicensePlate($licensePlate);
                $resident = User::getResident($licensePlate);
                if ($visits) {
                    return view(
                        'visitorExit',
                        [
                            'visits' => $visits,
                            'visitorTypes' => $visitorTypes,
                            'authorisationStatus' => $authorisationStatuses,
                            'addresses' => $addresses,
                            'communities' => $communities,
                            'vehicle' => $vehicle,
                            'vehicleTypes' => $vehicleTypes,
                            'vehicleColors' => $vehicleColors

                        ]
                    );
                } elseif ($resident) {
                    return view(
                        'residentExit',
                        [
                            'resident' => $resident,
                            'visitorTypes' => $visitorTypes,
                            'authorisationStatus' => $authorisationStatuses,
                            'addresses' => $addresses,
                            'communities' => $communities,
                            'vehicle' => $vehicle,
                            'vehicleTypes' => $vehicleTypes,
                            'vehicleColors' => $vehicleColors

                        ]
                    );
                }
            } else {
                return view('exit');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $visitor = Egress::getVisitByLicensePlate($request->input('license_plate'));
        Log::info($visitor);
        if ($visitor) {

            try {
                $exit = Egress::create([
                    'entry_id/resident_id' => $request->input('entry_id'),
                    'egress_person_type' => 'visit'
                ]);
            } catch (Exception $e) {
                Log::error($e->getMessage());
            };
            return redirect()->route('exit')->with('status', 'Exit Successfully updated');
        } else {

            $resident = User::getResidentByLicensePlate($request->input('license_plate'));
            Log::info($resident);
            if ($resident) {
                return view('pinConfirmation', ['resident' => $resident]);
            } else {
                return redirect()->route('exit')->with('status', 'NO INFORMATION FOUND');
            }
        }
    }

    public function pinConfirmation(Request $request)
    {

        $check = ResidentDetail::getResidentDetailsById($request->input('resident_id'));
        Log::info($check);
        Log::info(Hash::check($request->input('pin'), $check[0]->pin));
        if (Hash::check($request->input('pin'), $check[0]->pin)) {

            try {
                $exit = Egress::create([
                    'entry_id/resident_id' => $request->input('resident_id'),
                    'egress_person_type' => 'resident'
                ]);
            } catch (Exception $e) {
                Log::error($e->getMessage());
            };
        }
        return redirect()->route('exit')->with('status', 'RESIDENT EXIT SUCCESSFULLY UPDATED');
    }
}
