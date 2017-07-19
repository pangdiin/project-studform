<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\Slide;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SlideTableSeeder extends Seeder
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
        $this->truncate('slides');


        $faker = Faker::create();
		foreach (range(1, 5) as $index) {
			$data['title' 		] = $faker->company;
			$data['description' ] = $faker->paragraph();
			$data['path'		] = $faker->imageUrl(1024, 720);
			Slide::create($data);
        }

        $this->enableForeignKeys();
    }
}
