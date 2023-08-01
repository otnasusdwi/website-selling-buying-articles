<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ToolsController;

class CheckOvertime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:overtime';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Overtime';

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
     * @return int
     */
    public function handle()
    {
        ToolsController::checkOvertime();
        // echo "ok";
    }
}
