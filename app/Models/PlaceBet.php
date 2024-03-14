<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
class PlaceBet extends Model
{
    use HasFactory;
    protected $table = 'bet_history';
    protected $fillable = [
        'stake',
        'potential_winnings',
        'num_events',
        'status',
        'selections',
        'bonus',
        'type',
        'total_odds',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public $keyType = 'string';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();
       
         static::creating(function ($placebet){
            $uuid = str_replace('-', '', Str::uuid()->toString());
            $placebet->id = substr($uuid, 0, 10);
            $placebet->selections = json_encode($placebet->selections);
         });
      
    }
    
}
