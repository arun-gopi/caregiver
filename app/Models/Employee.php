<?php


namespace App\Models;

use App\Http\Controllers\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Teamwork\Traits\UsedByTeams;

class Employee extends Model
{
    use UsedByTeams;
    use HasUuid;
    use \Zoha\Metable;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $metaTable = 'employees_meta';
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    // public function users()
    // {
    //     return $this->belongsToMany(User::class);
    // }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
