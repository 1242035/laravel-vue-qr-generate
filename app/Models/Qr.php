<?php

namespace App\Models;

class Qr extends Base
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';

    protected $table = 'qrs';

    protected $fillable = [
        'user_id', 'ft_search','full_name','mobile','street','city_code','state_code','country_code','size','file'
    ];

    /*
    public function setFullNameAttribute($value)
    {
        $this->attributes['ft_search'] = strtolower($value);
    }
    */
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
