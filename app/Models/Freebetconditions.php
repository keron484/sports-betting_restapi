<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Freebetconditions extends Model
{
    use HasFactory;

    protected $table = 'freebetcondtions';
    protected $fillable = [
        'active',
        'min_odds',
        'min_numevents',
        'min_numwager'
    ];

    public $incrementing = false;
    public $keyType = 'string';

    protected static function boot(){
        parent::boot();
       
        static::creating(function ($user){
           $uuid = str_replace('-', '', Str::uuid()->toString());
           $user->id = substr($uuid, 0, 15);
        });
     
    }
}
