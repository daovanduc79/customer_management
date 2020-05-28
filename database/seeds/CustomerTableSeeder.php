<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataArray = [];
        for ($i = 1; $i < 10; $i++) {
            $dataArray[] = [
                'name'=> Str::random(10),
                'dob'=>date('Y-m-d',mt_rand(1, time())),
                'email'=>Str::random(10).'@gmail.com',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ];
        }
        DB::table('customers')->insert($dataArray);
    }
}
