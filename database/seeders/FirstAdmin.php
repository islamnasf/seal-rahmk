<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FirstAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create($this->adminData());
    }
    private function adminData(){
        return[
            'name'=>'admin',
            'email'=>'admin@yahoo.com',
            'role'=>'1',
            'usertype'=>'0',
            'password'=>Hash::make("Admin2022"),
            'email_verified_at'=>carbon::now(),
        ];
    } 
}
