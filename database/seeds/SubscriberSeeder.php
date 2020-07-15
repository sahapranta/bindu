<?php

use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('subscribers')->delete();
        factory(App\Subscriber::class, 50)->create();
    }
}
