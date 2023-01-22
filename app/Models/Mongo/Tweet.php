<?php

namespace App\Models\Mongo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
class Tweet extends Model
{
    use HasFactory;
    protected $fillable = ['id','text' , 'user_id' , 'created_at'];
    protected $primaryKey = 'id';
    protected $connection = 'mongodb';
    protected $dates = ['created_at' , 'updated_at'];

}
