<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $user_maarten = new User([
            'username' => 'slipperydippery',
            'email' => 'maartendejager@gmail.com',
            'password' => Hash::make('password'),
            'dev' => 1,
            'verified' => 1,
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);
        $user_maarten->save();
    }
}
