<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','admin@smartindia.com')->first();
        if(!$user){
            //Create Super Admin user if not exists
            $password = Hash::make('SuperAdmin');

            //Create User
            $user = new User();
            $user->name = 'SuperAdmin';
            $user->email = 'admin@smartindia.com';
            $user->password = $password;
            $user->remember_token = '00000';
            $user->phone = '0000';
            $user->type = '0';
            $user->status = 1;
            $user->affiliate_id = '00000';
            $user->save();

            
        }
    }
}
