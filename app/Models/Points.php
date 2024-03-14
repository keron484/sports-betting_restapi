<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Base;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
class Points extends Base
{
    use HasFactory;

    protected $table = 'points';  
    protected $fillable = [
      'user_id',
      'points'
    ];
    public function mypoints() : BelongsTo{
      return $this->belongsTo(User::class);
    }
    
    public $keyType = 'string';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();

        // Generate a UUID for the 'id' field when creating a new User
        static::creating(function ($user) {
            $uuid = str_replace('-', '', Str::uuid()->toString());
            $user->id = substr($uuid, 0, 10);
        });
    }
}
