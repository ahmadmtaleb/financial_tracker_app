<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * @var string
    */
    protected $table = 'transactions';
    protected $fillable = ['title', 'description', 'amount', 'category_id', 'start_date', 'end_date', 'interval', 'type', 'currency_id'];


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
