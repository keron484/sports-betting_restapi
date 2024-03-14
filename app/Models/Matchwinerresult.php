<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Matchwinerresult extends Model
{
    use HasFactory;

    protected $table = 'match_winner_result';
    public $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
       'hometeam_win',
       'awayteam_win',
       'draw',
       'home_doublechance',
       'away_doublechance',
       'home_or_away'
    ];


    protected static function boot(){
        parent::boot();
       
        static::creating(function ($matchwinnerresult){
           $uuid = str_replace('-', '', Str::uuid()->toString());
           $matchwinnerresult->id = substr($uuid, 0, 15);
        });
    }
}
