<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    protected $fillable = ['acct_owner', 'acct_no', 'acct_nric','acct_balance'];
}
