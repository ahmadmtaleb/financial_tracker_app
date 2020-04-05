<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    /**
     * @var string
    */
    protected $table = 'currencies';

    /**
     * @var array
    */
    protected $guarded = [];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}
