<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class ResidentDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'usersResident_id',
        'pin',
            'security_question_1',
            'security_answer_1',
            'security_question_2',
            'security_answer_2',
            'security_question_3',
            'security_answer_3',
            'vehicle_model',
            'vehicle_color',
            'license_plate',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'usersResident_id';

    public static function getResidentDetailsById($id){

        $residentDetail = new Collection();
        try{
            $residentDetail = DB::table('resident_details')
                            ->join('users','resident_details.usersResident_id','=','users.id')
                            ->where('users.id','=',"$id")
                            ->select(['users.id','users.name as name','users.email','users.id_address','security_question_1', 'security_answer_1','users.lot','security_question_2', 'security_answer_2','security_question_3', 'security_answer_3','pin'])
                            ->get();

            if($residentDetail){
                return $residentDetail;
            }
        }catch(Exception $error){
            Log::error("Error trying to get ResidentDetailsById" . $error->getMessage());

        }

        return $residentDetail;
    }

}
