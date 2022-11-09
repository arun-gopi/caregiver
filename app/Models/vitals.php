<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Teamwork\Traits\UsedByTeams;

class vitals extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    use UsedByTeams;
    use HasFactory;
}
