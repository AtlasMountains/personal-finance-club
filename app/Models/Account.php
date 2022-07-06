<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'account_type_id',
        'family_id',
        'start_balance',
        'alert',
    ];

    protected $attributes = [
        'family_id' => null,
        'start_balance' => 0,
        'alert' => 0,
    ];

    public function getRouteKeyName()
    {
        return 'name';
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
