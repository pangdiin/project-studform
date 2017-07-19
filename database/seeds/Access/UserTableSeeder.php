<?php

use Database\TruncateTable;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Illuminate\Support\Facades\DB;

use App\Models\Access\User\User;
use App\Models\Access\User\Profile;
use Faker\Factory as Faker;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate(config('access.users_table'));

        //Add the master administrator, user id of 1

        $this->createAdmin();
        $this->createExecutive();
        $this->createUser();

        
        // $faker = Faker::create();
        // foreach (range(1, 5) as $index) {
        //     $data['title'       ] = $faker->company;
        //     $data['description' ] = $faker->paragraph();
        //     $data['path'        ] = $faker->imageUrl(1024, 720);
        //     Slide::create($data);
        // }



        // $users = [
        //     [
        //         'username'          => 'admin',
        //         'email'             => 'admin@admin.com',
        //         'password'          => bcrypt('Admin!123'),
        //         'confirmation_code' => md5(uniqid(mt_rand(), true)),
        //         'confirmed'         => true,
        //         'created_at'        => Carbon::now(),
        //         'updated_at'        => Carbon::now(),
        //     ],
        //     [
        //         'username'          => 'executive',
        //         'email'             => 'executive@executive.com',
        //         'password'          => bcrypt('Executive!123'),
        //         'confirmation_code' => md5(uniqid(mt_rand(), true)),
        //         'confirmed'         => true,
        //         'created_at'        => Carbon::now(),
        //         'updated_at'        => Carbon::now(),
        //     ],
        //     [
        //         'username'          => 'user',
        //         'email'             => 'user@user.com',
        //         'password'          => bcrypt('User!123'),
        //         'confirmation_code' => md5(uniqid(mt_rand(), true)),
        //         'confirmed'         => true,
        //         'created_at'        => Carbon::now(),
        //         'updated_at'        => Carbon::now(),
        //     ],
        // ];

        // DB::table(config('access.users_table'))->insert($users);

        $this->enableForeignKeys();
    }

    public function createAdmin()
    {
        $model = [
            'username'          => 'admin',
            'email'             => 'admin@admin.com',
            'password'          => bcrypt('Admin!123'),
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];
        $model = User::create($model);
        $faker = Faker::create();
        $card = $faker->creditCardDetails;
        $profile = $model->profile()->create([
            'first_name'        => 'Admin',
            'last_name'         => 'Inistrator',
            'address'           => $faker->address,
            'avatar'            => $faker->imageUrl(300, 300),
            'contact_number'    => $faker->phonenumber,

            // 'card_number'       => $card['number'],
            // 'card_expire'       => $card['expirationDate'],
            // 'card_cvv'          => substr($card['number'], -3),
            
        ]);
    }

    public function createExecutive()
    {
        $model = [
            'username'          => 'executive',
            'email'             => 'executive@executive.com',
            'password'          => bcrypt('HedgeHog!123'),
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];
        $model = User::create($model);
        $faker = Faker::create();
        $card = $faker->creditCardDetails;
        $profile = $model->profile()->create([
            'first_name'        => 'Executive',
            'last_name'         => 'Client',
            'address'           => $faker->address,
            'avatar'            => $faker->imageUrl(300, 300),
            'contact_number'    => $faker->phonenumber,

            // 'card_number'       => $card['number'],
            // 'card_expire'       => $card['expirationDate'],
            // 'card_cvv'          => substr($card['number'], -3),
            
        ]);
    }

    public function createUser()
    {
        $model = [
            'username'          => 'user',
            'email'             => 'user@user.com',
            'password'          => bcrypt('User!123'),
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];
        $model = User::create($model);
        $faker = Faker::create();
        $card = $faker->creditCardDetails;
        $profile = $model->profile()->create([
            'first_name'        => 'User',
            'last_name'         => 'Default',
            'address'           => $faker->address,
            'avatar'            => $faker->imageUrl(300, 300),
            'contact_number'    => $faker->phonenumber,

            // 'card_number'       => $card['number'],
            // 'card_expire'       => $card['expirationDate'],
            // 'card_cvv'          => substr($card['number'], -3),
            
        ]);
    }
}


