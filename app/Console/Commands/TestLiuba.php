<?php


namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class TestLiuba extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ЭЭЭ просто проверка';

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
        // DB::table('todos')->where("status", 0)->delete();
         //dd(Carbon::today()->format('l'));

         if(Carbon::now()->setTimezone('GMT+9')->format('H:i' ) == "19:57" ) {

          $deals = DB::table('todos')->where("status", 0)->where('date', Carbon::today()->format('Y-m-d'))->get();

                Mail::to('liubov.iakovleva5@gmail.com')->send(new \App\Mail\everyDayNotification($deals));
         }

    }
}
