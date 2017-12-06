<?php

namespace App\Models;

class Country extends Base
{
    
    protected $table = 'locations_countries';
    
    public $timestamps = false;
        
    protected $fillable = [
        'name', 'alt_name','capital','alt_capital','iso_a2','iso_a3','iso_num','fips','lat','lng','region_code','neighbours','languages','currency','flag','sort_order'
    ];
}
