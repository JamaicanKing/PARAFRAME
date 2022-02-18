<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;

class Avatar extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'avatar'
   ];

   /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    public static function getAvatarById($id) {

        try{
            $avatar = DB::table('avatars')
                            ->join('users','avatars.user_id','=','users.id')
                            ->where('users.id','=',"$id")
                            ->select(['user_id','avatar'])
                            ->get();

            if($avatar){
                return $avatar;
            }
        }catch(Exception $error){
            Log::error("Error trying to get Avatar By Id" . $error->getMessage());

        }

        return [];
    }


}