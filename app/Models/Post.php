<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
	    'id_visit',
	    'id_user',
	    'name_visitor',
	    'visitor_type',
	    'status_authorisation',
	    'created_by',
    ];
}
