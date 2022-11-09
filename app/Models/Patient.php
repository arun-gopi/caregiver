<?php

namespace App\Models;

use App\Http\Controllers\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Teamwork\Traits\UsedByTeams;

class Patient extends Model
{
    use UsedByTeams;
    use HasUuid;
    use \Zoha\Metable;
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $metaTable = 'patients_meta';
    use HasFactory;
    
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function emergencycontacts()
    {
        return $this->hasMany(emergencycontact::class);
    }
    public function diagnosis()
    {
        return $this->hasMany(pt_diagnosis::class);
    }
}
