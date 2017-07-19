<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class DropTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'table:drop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop all tables';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::beginTransaction();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach (\DB::select('SHOW TABLES') as $table) {
            $table_array = get_object_vars($table);
            \Schema::drop($table_array[key($table_array)]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        DB::commit();

        $this->comment(PHP_EOL.'If no errors showed up, all tables were dropped'.PHP_EOL);

    }
}
