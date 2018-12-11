<?php

use Illuminate\Database\Seeder;

class StatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'status'=>'Em Aberto'
        ]);
        DB::table('status')->insert([
            'status'=>'Fechado'
        ]);
    }
}
