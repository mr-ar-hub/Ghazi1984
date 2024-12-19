<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
    use HasFactory;
    protected $table = 'bank_details';
    protected $fillable = [
        'account_holder_name',
        'bank_name',
        'account_number',
        'branch',
        'iban',
        'bic',
        'swift_code',
        'status'
    ];
}
