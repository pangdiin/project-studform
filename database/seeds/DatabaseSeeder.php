<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DatabaseSeeder.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(AccessTableSeeder::class);
        $this->call(HistoryTypeTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(SlideTableSeeder::class);
        $this->call(BlockTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(SettingTableSeeder::class);

        Model::reguard();
    }
}
