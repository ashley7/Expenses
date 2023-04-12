<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $saveUser = new User();

        $saveUser->name = "Charles";

        $saveUser->phone_number = "0787444082";

        $saveUser->password = Hash::make('123123');

        try {
            $saveUser->save();
        } catch (\Throwable $th) {}
    }
}
