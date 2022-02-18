<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class Egress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'entry_id/resident_id',
        'egress_person_type'
        
    ];


    public static function getVisitByVisitID($id){
        
        $visit = new Collection();
        //DB::enableQueryLog();

        try
        {
            $visit = DB::table('visits')
                            ->join('users','visits.id_user','=','users.id')
                            ->join('addresses','users.id_address','=','addresses.id')
                            ->join('communities','addresses.id_communities','=','communities.id')
                            ->join('entries','visits.id','=','entries.id_visits')
                            ->where('visits.id','=',"$id")
                            ->select(['visits.id as visit_id','visits.id_user','visits.name_visitor','visits.visitor_type', 'visits.status_authorisation','users.name as name', 'visits.license_plate','addresses.name as address','communities.name as community','users.lot','entries.id as entry_id'])
                            ->get();

            //Log::info(DB::getQueryLog());
            //dd($visit);
        }
        catch(Exception $error){
            Log::error("Error trying to get Visits By Vsitor Name" . $error->getMessage());

        }
        
        return $visit;
    }
    public static function getVisitByVisitorName($visitorName){
        
        $visit = new Collection();
        //DB::enableQueryLog();

        try
        {
            $visit = DB::table('visits')
                            ->join('users','visits.id_user','=','users.id')
                            ->join('addresses','users.id_address','=','addresses.id')
                            ->join('communities','addresses.id_communities','=','communities.id')
                            ->join('entries','visits.id','=','entries.id_visits')
                            ->where('visits.name_visitor','LIKE',"%$visitorName%")
                            ->select(['visits.id as visit_id','visits.id_user','visits.name_visitor','visits.visitor_type', 'visits.status_authorisation','users.name as name', 'visits.license_plate','addresses.name as address','communities.name as community','users.lot','entries.id as entry_id'])
                            ->get();

            //Log::info(DB::getQueryLog());
            //dd($visit);
        }
        catch(Exception $error){
            Log::error("Error trying to get Visits By Vsitor Name" . $error->getMessage());

        }
        
        return $visit;
    }

    public static function getVisitByLicensePlate($licensePlate){
        try{
            $visit = DB::table('visits')
                            ->join('users','visits.id_user','=','users.id')
                            ->join('addresses','users.id_address','=','addresses.id')
                            ->join('communities','addresses.id_communities','=','communities.id')
                            ->join('entries','visits.id','=','entries.id_visits')
                            ->where('visits.license_plate','LIKE',"%$licensePlate%")
                            ->select(['visits.id as visit_id','visits.id_user','visits.name_visitor','visits.visitor_type', 'visits.status_authorisation','users.name as name', 'visits.license_plate','addresses.name as address','communities.name as community','users.lot','entries.id as entry_id'])
                            ->get();

            if($visit){
                return $visit;
            }
        }catch(Exception $error){
            Log::error("Error trying to get Visits By Vsitor Name" . $error->getMessage());

        }

        return [];
    }

}
