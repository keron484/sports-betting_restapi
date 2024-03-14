<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Base;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
class Affiliate extends Base
{
    use HasFactory;
    protected $table = 'affiliate';
    protected $fillable = [
       'username',
       'email',
       'phone',
       'country',
       'status',
       'first_name',
       'last_name',
       'age',
       'address',
       'region',
       'gender',
       'rank',
       'promo_code',
       'withdrawable_balance',
       'monthly_withdrawalble_balance',
       'prove_identity_image',
       'influencer_link'
    ];

    public function user() : HasMany{
        return $this->hasMany(User::class);
    }
     
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
