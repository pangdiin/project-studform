<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\Block;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BlockTableSeeder extends Seeder
{
	use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *sss
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('blocks');

        $faker = Faker::create();

        Block::create([
            'name'          => 'Contact Us',
            'slug'   		=> 'Contact Us',
            'content'		=> 'Freecall 1800 352 366<br>PO Box 427<br>Mount Gambier SA 5290',
            'position'      => 'bottom-left',
            'status'        => 'active'
        ]);

        $this->enableForeignKeys();
    }
}
