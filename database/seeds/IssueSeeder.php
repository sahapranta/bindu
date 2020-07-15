<?php

use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('issues')->delete();
        factory(App\Issue::class, 10)->create();
    }
}
