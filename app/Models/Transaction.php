<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'recipient',
        'message',
        'date',
        'type_id',
        'tag_id',
        'category_id',
        'account_id',
    ];

    protected $attributes = [
        'tag_id' => null,
        'category_id' => null,
    ];

    public function Type()
    {
        return $this->belongsTo(Type::class);
    }

    public function Tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Account()
    {
        return $this->belongsTo(Account::class);
    }
}
