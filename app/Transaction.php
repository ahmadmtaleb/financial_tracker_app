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
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function currencies()
    {
        return $this->belongsTo(Currency::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
    
}
