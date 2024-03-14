<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Firsthalftotalresults extends Model
{
    use HasFactory;
    
    protected $table = 'firsthalftotalresults';
    protected $fillable = [

    ];

    public $incrementing = false;
    public $keyType = 'string';

    protected static function boot(){
        parent::boot();
       
        static::creating(function ($overunder){
           $uuid = str_replace('-', '', Str::uuid()->toString());
           $overunder->id = substr($uuid, 0, 15);
        });
    }

}
