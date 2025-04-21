<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    protected $guarded = [];

    public function transaction_payment() : HasOne
    {
        return $this->hasOne(TransactionPayment::class);
    }
}
