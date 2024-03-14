<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Base;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Freebets extends Base
{
    use HasFactory;
    protected $table = 'free_bets';
    protected $fillable = [
        'user_id',
        'value',
        'expire_date',
    ];
    
    public $incrementing = false;
    public $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
       
         static::creating(function ($user){
            $uuid = str_replace('-', '', Str::uuid()->toString());
            $user->id = substr($uuid, 0, 6);
         });
      
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
