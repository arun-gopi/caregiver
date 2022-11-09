<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class UserSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() { 
        User::truncate(); 
        $users = [ 
         [ 
           'name' => 'Super Admin',
           'email' => 'superadmin@gmail.com',
           'password' => 'password',
         ],
         [
           'name' => 'User',
           'email' => 'user@gmail.com',
           'password' => 'password',
         ],
          [
           'name' => 'Client',
           'email' => 'client@gmail.com',
           'password' => 'password',
         ] 
       ];

       foreach($users as $user)
       {
           User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password'])
          ]);
        }

 }
}
