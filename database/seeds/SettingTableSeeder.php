<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\Setting;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
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
        $this->truncate('settings');
        foreach (config('setting') as $t => $type) {
        	foreach ($type['data'] as $d => $data) {
        		Setting::create([
        			'key' 		=> $d, 
        			'type' 		=> $t, 
        			'group' 	=> $data['group'  ], 
        			'icon' 		=> $data['icon'   ], 
        			'field' 	=> $data['field'  ], 
        			'display' 	=> $data['display'], 
        			'value' 	=> $data['value'  ], 
        		]);
        	}
        }

        $this->enableForeignKeys();
    }
}
