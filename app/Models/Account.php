<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use Sluggable;
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'account_type_id',
        'family_id',
        'start_balance',
        'alert',
        'user_position',
        'position',
    ];

    protected $attributes = [
        'family_id' => null,
        'start_balance' => 0,
        'alert' => 0,
        'position' => 0,
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function accountType()
    {
        return $this->belongsTo(AccountType::class);
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
