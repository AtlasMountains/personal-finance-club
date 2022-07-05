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
        'transaction_type_id',
        'transaction_tag_id',
    ];

    protected $attributes = [
        'transaction_tag_id' => null
    ];

    public function TransactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function tag()
    {
        return $this->belongsTo(TransactionTag::class);
    }

    public function category()
    {
        return $this->belongsTo(TransactionCategory::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
