<?php

namespace App\Models;

use Collator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_address',
        'lot'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getAllResidents(){
        try{
            $resident = DB::table('users')
                            ->join('role_user','users.id','=','user_id')
                            ->join('roles','role_user.role_id','=','roles.id')
                            ->where('roles.name','=','RESIDENT')
                            ->select(['users.id','users.name','roles.name as role_name'])
                            ->get();

            if($resident){
                return $resident;
            }
        }catch(Exception $error){
            Log::error("Error trying to get resident by name" . $error->getMessage());

        }

        return [];
    }


    public static function getResidentId($id){

        $resident = new Collection();

        try{
            $resident = DB::table('users')
                            ->join('addresses','users.id_address','=','addresses.id')
                            ->join('communities','addresses.id_communities','=','communities.id')
                            ->where('users.id','=',"$id")
                            ->select(['users.id','users.email','users.name','users.lot as lot','users.id_address','addresses.name as address','communities.id as community_id','communities.name as community_name'])
                            ->get();

        }catch(Exception $error){
            Log::error("Error trying to get resident by name" . $error->getMessage());

        }

        return $resident;
    }

    public static function getResident($userName){
        try{
            $resident = DB::table('users')
                            ->join('role_user','users.id','=','user_id')
                            ->join('roles','role_user.role_id','=','roles.id')
                            ->where('users.name','LIKE',"%$userName%")
                            ->where('roles.name','=','RESIDENT')
                            ->select(['users.id','users.name','roles.name as role_name'])
                            ->get();

            if($resident){
                return $resident;
            }
        }catch(Exception $error){
            Log::error("Error trying to get resident by name" . $error->getMessage());

        }

        return [];
    }

    public static function getResidentByAddress($address){
        try{
            $resident = DB::table('users')
                            ->join('addresses','users.id_address','=','addresses.id')
                            ->join('communities','addresses.id_communities','=','communities.id')
                            ->where('addresses.name','LIKE',"%$address%")
                            ->select(['users.id','users.name','users.lot','users.id_address','addresses.id as address_id','addresses.name as address','communities.id as community_id','communities.name as community_name'])
                            ->get();

            if($resident){
                return $resident;
            }
        }catch(Exception $error){
            Log::error("Error trying to get resident by name" . $error->getMessage());

        }

        return [];
    }

    public static function getResidentByLicensePlate($licensePlate){
        try{
            $resident = DB::table('users')
                            ->join('addresses','users.id_address','=','addresses.id')
                            ->join('communities','addresses.id_communities','=','communities.id')
                            ->join('avatars','users.id','=','avatars.user_id')
                            ->join('vehicles','users.id','=','vehicles.user_id')
                            ->where('vehicles.license_plate','LIKE',"%$licensePlate%")
                            ->select(['avatars.avatar','vehicles.license_plate','vehicles.name as vehicle_name','users.id','users.name','users.lot','users.id_address','addresses.id as address_id','addresses.name as address','communities.id as community_id','communities.name as community_name'])
                            ->get();

            if($resident){
                return $resident;
            }
        }catch(Exception $error){
            Log::error("Error trying to get resident By LicensePlate" . $error->getMessage());

        }

        return [];
    }
}
