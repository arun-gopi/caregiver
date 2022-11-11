<?php

namespace App\Models;

use App\Http\Controllers\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Teamwork\Traits\UsedByTeams;

class hha_forms extends Model
{
    use UsedByTeams;
    use \Zoha\Metable;
    use HasUuid;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    protected $metaTable = 'hha_forms_meta';
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
