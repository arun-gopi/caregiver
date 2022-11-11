<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    use HasFactory;

    
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
