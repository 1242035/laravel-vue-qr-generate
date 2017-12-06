<?php

namespace App\Models;

class State extends Base
{
    protected $table = 'locations_states';

    public $timestamps = false;

    protected $fillable = [
        'name', 'alt_name','capital','alt_capital','country_code','iso','fips','hasc','level','types','alt_types','lat','lng','postcode','neighbours','languages','currency','flag','map','url','sort_order'
    ];

    public function scopeCountry($query, $countryCode)
    {
        return $query->where('country_code', $countryCode);
    }

}
