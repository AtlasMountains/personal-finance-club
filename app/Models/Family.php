<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'head',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function accountsWithTypes()
    {
        return $this->hasMany(Account::class)->with('accountType');
    }

    public function usersWithAccounts()
    {
//        return User::whereBelongsTo($this)->with('accounts')->get();
        //todo check relation
        return $this->hasMany(User::class)->with('accounts');
    }
}
