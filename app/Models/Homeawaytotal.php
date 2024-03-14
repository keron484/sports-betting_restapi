<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Homeawaytotal extends Model
{
    use HasFactory;

    protected $table = 'homeawaytotalresult';
    protected $fillable = [
        'hometotal_overhalf',
        'hometotal_overone',
        'hometotal_overtwo',
        'hometotal_overthree',
        'hometotal_overfour',
        'hometotal_overfive',
        'hometotal_oversix',
        'hometotal_underhalf',
        'hometotal_underone',
        'hometotal_undertwo',
        'hometotal_underthree',
        'hometotal_underfour',
        'hometotal_underfive',
        'hometotal_undersix',
        'awaytotal_overhalf',
        'awaytotal_overtwo',
        'awaytotal_overthree',
        'awaytotal_overfour',
        'awaytotal_overfive',
        'awaytotal_underhalf',
        'awaytotal_underone',
        'awaytotal_undertwo',
        'awaytotal_underthree',
        'awaytotal_underfour',
        'awaytotal_underfive',
        'awaytotal_undersix',
    ];
    public $keyType = 'string';
    public $incrementing = false;

    protected static function boot(){
        
            parent::boot();
           
            static::creating(function ($homeawaytotal){
               $uuid = str_replace('-', '', Str::uuid()->toString());
               $homeawaytotal->id = substr($uuid, 0, 15);
            });
         
    }

}
