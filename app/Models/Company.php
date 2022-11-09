<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Traits\HasUuid;
use Mpociot\Teamwork\Traits\UsedByTeams;

class Company extends Model
{

    use UsedByTeams;
    use HasUuid;
    use \Zoha\Metable;
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $metaTable = 'companies_meta';


    public function getRouteKeyName()
    {
        return 'uuid';
    }

    

}
