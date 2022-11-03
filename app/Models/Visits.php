<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;


class Visits extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_user',
        'name_visitor',
        'visitor_type',
        'status_authorisation',
        'license_plate',
        'created_by'
    ];

    public static function getResidentCurrentDayVisits($id){

        try{
        $visits = DB::select("SELECT 
        visits.name_visitor as name,
         visits.id as id,
         visitor_type,
         status_authorisation,
         visits.created_by,
         users.name as user_name, 
         visits.created_at,
         visits.license_plate
FROM `visits` 
  INNER JOIN users ON visits.created_by = users.id
         WHERE CONVERT(visits.created_at, DATE) = curdate() AND id_user = $id
         UNION SELECT 
        visits.name_visitor as name,
         visits.id as id,
         visitor_type,
         status_authorisation,
         visits.created_by,
         users.name as user_name, 
         visits.created_at,
         visits.license_plate
                            FROM `visits` 
                             INNER JOIN users ON visits.created_by = users.id
                             WHERE status_authorisation = 'MULTIPLE ENTRY - (WHITELIST)' AND id_user = $id
        UNION SELECT 
        visits.name_visitor as name,
         visits.id as id,
         visitor_type,
         status_authorisation,
         visits.created_by,
         users.name as user_name, 
         visits.created_at,
         visits.license_plate
                            FROM `visits` 
                             INNER JOIN users ON visits.created_by = users.id
                             WHERE status_authorisation = 'DENY ENTRY - (BLACKLIST)' AND id_user = $id
ORDER BY status_authorisation, created_at  ;");

    if($visits){
        return $visits;
    }

    }
    catch(Exception $error){
        Log::error("Error trying to get visits by ID: " . $error->getMessage());
    }

    return [];
    }

    public static function getVisitByVisitorName($visitorName){
        try{
            $visit = DB::table('visits')
                            ->join('users','visits.id_user','=','users.id')
                            ->where('visits.name_visitor','LIKE',"%$visitorName%")
                            ->select(['visits.id as visit_id','visits.id_user','visits.name_visitor','visits.visitor_type', 'visits.status_authorisation','users.name as name', 'visits.license_plate'])
                            ->get();

            if($visit){
                return $visit;
            }
        }catch(Exception $error){
            Log::error("Error trying to get Visits By Vsitor Name" . $error->getMessage());

        }

        return [];
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
