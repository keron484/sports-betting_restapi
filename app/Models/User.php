<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'phone_number',
        'account_balance',
        'bonus_acc_balance',
        'avatar',
        'country',
        'promo_code',
        'betting_limit',
        'proveofid_image',
        'age',
        'first_name',
        'last_name',
        'state',
        'gender',
        'address',
        'preferred_language',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public $keyType = 'string';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();
       
         static::creating(function ($user){
            $uuid = str_replace('-', '', Str::uuid()->toString());
            $user->id = substr($uuid, 0, 10);
         });
      
    }
    
    //defining the relationship between the user and the bets which can be placed by the user
    public function Mybets(): HasMany {
        return $this->hasMany(PlaceBet::class);
    }

    //defining the relationship between the user and the freebets he/she can have
    public function Myfreebets(): HasMany {
        return $this->hasMany(Freebets::class);
    }

    //defining the relationhsip between the user and the selections he or she can save
    public function MysavedSelections(): HasMany {
        return $this->hasMany(SavedSelections::class);
    }

    //defining the relationship between the user and the affiliate
    public function AffiliateParent(): BelongsTo {
        return $this->belongsTo(Affiliate::class);
    }

}
