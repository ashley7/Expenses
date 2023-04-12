<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    public function service()
    {

        return $this->belongsTo(Service::class);
    
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);

    }

   
}
