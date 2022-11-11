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

    public function users()
    {
  
      return $this->belongsToMany(User::class, 'company_user');
    }

    public function visit_types()
    {
  
      return $this->hasMany(visit_type::class);
    }

    public function attachUser($user)
    {
      if (is_object($user)) {
        $user = $user->getKey();
      }
      if (is_array($user)) {
        $user = $user['id'];
      }
      $this->users()->attach($user);
    }
  
    public function detachUser($user)
    {
      if (is_object($user)) {
        $user = $user->getKey();
      }
      if (is_array($user)) {
        $user = $user['id'];
      }
      $this->users()->detach($user);
    }
  
    public function attachRUsers($users)
    {
      foreach ($users as $user) {
        $this->attachuser($user);
      }
    }
  
    public function detachRUsers($users)
    {
      foreach ($users as $user) {
        $this->detachuser($user);
      }
    }
    

}
