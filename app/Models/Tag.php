<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'tag',
    ];

    public function Transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function Users()
    {
        return $this->belongsToMany(User::class);
    }
}
