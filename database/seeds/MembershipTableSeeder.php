<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\Page;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Membership\Membership;

class MembershipTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('memberships');


        $faker = Faker::create();

        $free_trial = Membership::create([
            'name'          => 'Free Trial',
            'cost'          => 0,
            'plan'          => 45,
            'start'         => null,
            'description'   => $faker->paragraph(),
            'status'        => 1
        ]);

        // $first_trial = Membership::create([
        //     'name'          => 'First Free Trial',
        //     'cost'          => 0,
        //     'plan'          => 1,
        //     'start'         => null,
        //     'description'   => $faker->paragraph(),
        //     'status'        => 1
        // ]);

        // $second_trial = Membership::create([
        //     'name'          => 'Second Free Trial',
        //     'cost'          => 0,
        //     'plan'          => 1,
        //     'start'         => null,
        //     'description'   => $faker->paragraph(),
        //     'status'        => 1
        // ]);

        $premium = Membership::create([
            'name'          => 'Premium',
            'cost'          => 45,
            'plan'          => 1,
            'start'         => null,
            'description'   => $faker->paragraph(),
            'status'        => 1
        ]);

        $this->enableForeignKeys();
    }
}
