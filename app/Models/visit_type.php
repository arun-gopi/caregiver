<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visit_type extends Model
{
    use HasFactory;


    protected $table = 'visit_types';

    public function companies()
    {
  
      return $this->belongsTo(Company::class);
    }
}
