<?php

namespace App\Models;

class City extends Base
{
    protected $table = 'locations_cities';

    public $timestamps = false;

    protected $fillable = [
        'name', 'alt_name','capital','alt_capital','country_code','state_code','code','hasc','level','types','alt_types','lat','lng','postcode','neighbours','languages','currency','flag','map','url','sort_order'
    ];

    public function scopeCountry($query, $countryCode)
    {
        return $query->where('country_code', $countryCode);
    }

    public function scopeState($query, $stateCode)
    {
        return $query->where('state_code', $stateCode);
    }

    public function scopeCode($query, $code)
    {
        return $query->where('code', $code);
    }
}
