<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Overunder extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $keyType = 'string';
    protected $table = 'overunderresults';
    protected $fillable = [
       'over_half',
       'over_one',
       'over_two',
       'over_three',
       'over_four',
       'over_five',
       'over_six',
       'under_half',
       'under_one',
       'under_two',
       'under_three',
       'under_four',
       'under_five',
       'under_six',
    ];

    protected static function boot(){
        parent::boot();
       
        static::creating(function ($overunder){
           $uuid = str_replace('-', '', Str::uuid()->toString());
           $overunder->id = substr($uuid, 0, 15);
        });
    }
}
