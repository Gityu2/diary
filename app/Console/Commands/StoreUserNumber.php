<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserNumber;
use App\Models\User;

class StoreUserNumber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store_user_number';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $number = new UserNumber;

        $number->numbers = User::where('role_id', 2)->count();
        $number->save();
    }
}
