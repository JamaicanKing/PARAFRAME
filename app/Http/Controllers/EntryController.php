<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visits;
use App\Models\Communities;
use App\Models\VisitorType;
use App\Models\Addresses;
use App\Models\AuthorisationStatus;
use Illuminate\Support\Facades\Log;
use App\Models\VehicleColors;
use App\Models\Vehicle;
use App\Models\VehicleTypes;
use App\Models\Entry;
use Exception;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
         if(Auth::user()->hasRole('SECURITY')) {
            $visitorName = $request->input('name_visitor');
            $visitorTypes = VisitorType::all(['id', 'name']);
            $vehicle = Vehicle::all(['id', 'name']);
            $vehicleTypes = VehicleTypes::all(['id', 'name']);
            $vehicleColors = VehicleColors::all(['id', 'name']);
            $communities = Communities::all(['id', 'name']);
            $addresses = Addresses::all(['id', 'name']);
            if(isset($visitorName)){
                $visits = Visits::getVisitByVisitorName($visitorName);
            }else{
                $visits = [];
            }
            Log::info($visits);
            $authorisationStatuses = AuthorisationStatus::all(['id','name']);
            return view(
                'entry',
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
        $id = $request->input('visit_id');
        try{
        $entry = Entry::create([
            'id_visits' => $request->input('visit_id'),
            'vehicle' => $request->input('vehicle'),
            'vehicle_types' => $request->input('vehicle_type'),
            'vehicle_color' => $request->input('vehicle_color'),
        ]);

        }catch(Exception $e){
            Log::error($e->getMessage());
        };

        try{
        if($entry){
            $visits = Visits::find($id);

            
            $visits->license_plate = $request->input('license_plate');

            $visits->save();

            
        }

        }catch(Exception $e){
            Log::error($e->getMessage());
        };
        return redirect()->route('entry')->with('status','Entry Successfully updated');
    }
}
