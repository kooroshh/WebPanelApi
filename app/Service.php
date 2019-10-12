<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name','platform_id','is_enabled'];
    protected $hidden = ['created_at','updated_at'];

    function platform(){
        return $this->belongsTo(Platform::class,'platform_id');
    }
    function servers(){
        return $this->hasMany(Server::class,'service_id');
    }
    function properties(){
        return $this->hasMany(Property::class,'service_id');
    }
}
