<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new User();
        $user->name = 'Alex';
        $user->email = "axiles94@gmail.com";
        $user->email_verified_at = now();
        $user->password = Hash::make('qwerty');
        $user->remember_token = Str::random(10);
        $user->save();
    }
}
