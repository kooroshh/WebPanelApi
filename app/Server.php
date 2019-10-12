<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = ['service_id'];
    protected $hidden = ['created_at','updated_at'];

    function properties(){
        return $this->hasMany(Value::class,'server_id');
    }
    function service(){
        return $this->belongsTo(Service::class, 'service_id');
    }
    function tags(){
        return $this->hasMany(ServerTag::class,'server_id');
    }
}
