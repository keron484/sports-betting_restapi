<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class AccumulatorBonus extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'bonus_percentage',
        'min_odds'
    ];
    protected $table = 'accumulator_bonus';
    
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
