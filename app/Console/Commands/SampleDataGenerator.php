<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\RouterDetail;
use Webpatser\Uuid\Uuid;
use Illuminate\Support\Str;

class SampleDataGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sample-data {count}';

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
     * @return mixed
     */
    public function handle()
    {
       $totalCount = $this->argument('count');
       if (!is_numeric($totalCount)) {
            echo  "Passed parameter is not an Integer value";
            exit;
       }
       for ($i=0; $i<$totalCount; $i++) {
            $newDetails = new RouterDetail();
            $newDetails->sapid= uniqid();
            $newDetails->host_name= 'Localhost';
            $newDetails->loop_back= "".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);
            $newDetails->mac_address= implode(':', str_split(str_pad(base_convert(mt_rand(0, 0xffffff), 10, 16) . base_convert(mt_rand(0, 0xffffff), 10, 16), 12), 2));
            $newDetails->save();
       }
       echo  $totalCount. " data got inserted successfully";
    }
}
