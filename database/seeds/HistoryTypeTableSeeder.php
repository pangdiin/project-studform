<?php

use Database\TruncateTable;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Database\DisableForeignKeys;
use Illuminate\Support\Facades\DB;

/**
 * Class HistoryTypeTableSeeder.
 */
class HistoryTypeTableSeeder extends Seeder
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
        $this->truncate('history_types');

        $types = [
            [
                'name'       => 'User',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Role',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Inquiry',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Tag',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Slide',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Page',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name'       => 'Block',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'       => 'Menu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name'       => 'Project',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name'       => 'Product',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'name'       => 'View',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('history_types')->insert($types);

        $this->enableForeignKeys();
    }
}
