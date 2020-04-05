<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * @var string
    */
    protected $table = 'categories';

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
        return $this->belongsTo(User::class);
    }
}
