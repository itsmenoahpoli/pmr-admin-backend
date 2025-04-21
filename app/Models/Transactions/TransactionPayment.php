<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionPayment extends Model
{
    protected $guarded = [];

    public function transaction() : BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
