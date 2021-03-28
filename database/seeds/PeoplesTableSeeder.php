<?php

use Illuminate\Database\Seeder;

class PeoplesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\People::create([
            'name'	=> "Muhammad Farhan",
            'email'	=> "farhan.ryukudo@gmail.com",
            'phone'	=> "0812-8118-4496",
        ]);
    }
}
