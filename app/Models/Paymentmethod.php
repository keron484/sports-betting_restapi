<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Base;
use Illuminate\Support\Str;
class Paymentmethod extends Base
{
    use HasFactory;
    protected $table = 'paymentmethods';
    protected $fillable = [
        'country',
        'type',
        'api',
        'status',
        'account_balance',
        'method_name',
    ];
    protected $keyType ='string';
    protected $incrementing = false;

    protected static function boot(){
        parent::boot();
       
        static::creating(function ($user){
           $ $uuid = str_replace('-', '', Str::uuid()->toString());
           $user->id = substr($uuid, 0, 20);
        }); 
    }
}
