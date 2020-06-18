<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use ZipArchive;
use File;

class ZipCreation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zip:create {count}';

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
        echo $totalCount. " Files Created Successfully".PHP_EOL;
        $newDirectory = rand();
        for ($i=0; $i<$totalCount; $i++) {
            Storage::put($newDirectory.DIRECTORY_SEPARATOR.'file'.($i+1).'.txt', 'test');
        }

        $zip = new ZipArchive;
   
        $fileName = $newDirectory.'.zip';

        if ($zip->open(storage_path('app'.DIRECTORY_SEPARATOR.$fileName), ZipArchive::CREATE) === TRUE)
        {
            $files = File::files(storage_path('app'.DIRECTORY_SEPARATOR.$newDirectory));

            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            
            $zip->close();
        }
        echo $fileName." Created Successfully".PHP_EOL;
        File::deleteDirectory(storage_path('app'.DIRECTORY_SEPARATOR.$newDirectory));
    }
}
