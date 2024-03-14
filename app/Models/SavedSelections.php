<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
class SavedSelections extends Model
{
    use HasFactory;

    protected $table = 'saved_selections';
    protected $fillable = [
        'user_id',
        'count',
        'type',
        'total_odds',
        'selections'
    ];
    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public $keyType = 'string';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();
       
         static::creating(function ($savedSelection){
            $uuid = str_replace('-', '', Str::uuid()->toString());
            $savedSelection->id = substr($uuid, 0, 5);
            $savedSelection->selections = json_encode($savedSelection->selections);
         });
    }
}
