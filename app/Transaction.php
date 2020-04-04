<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
     /**
     * @var string
     */
    protected $table = 'transactions';

    /**
     * @var array
     */
    protected $guarded = [];
}
