<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SSH;
use Storage;

class ScriptExecution extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'script:execute';

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
        $this->runTelNet();
        $this->nextSSH();
        $this->diskUsage();
        $this->inodeUsage();
        $this->listAll();
    }

    public function nextSSH()
    {
        Storage::disk('ftp')->put('test.txt','hello');
        echo "***File Uploaded Successfully***".PHP_EOL;
        echo "Uploaded file Content from server: ". Storage::disk('ftp')->get('test.txt').PHP_EOL;
        return;
    }

    public function diskUsage()
    {
        echo "***Executing disk usage***".PHP_EOL;
        echo shell_exec('df -h').PHP_EOL;
        return;
    }

    public function inodeUsage()
    {
        echo "***Inode Utilization On The File System***".PHP_EOL;
        echo shell_exec('df -i').PHP_EOL;

        echo "***Inode Usage Count***".PHP_EOL;
        echo shell_exec('find . -printf "%h\n" | cut -d/ -f-2 | sort | uniq -c | sort -rn').PHP_EOL;
    }
    
    public function listAll()
    {
        echo "***List All from current path***".PHP_EOL;
        echo shell_exec('ls -la').PHP_EOL;
    }


    public function runTelNet() 
    {
        $socket = fsockopen("localhost", 8000);

        if(!$socket)return;
        stream_set_blocking($socket, 0);
        stream_set_blocking(STDIN, 0);
        echo "Into the Telnet ".PHP_EOL;
        do {
        
        $read   = array( $socket, STDIN); $write  = NULL; $except = NULL;

        if(!is_resource($socket)) return;
        $num_changed_streams = @stream_select($read, $write, $except, null);
        if(feof($socket)) return ;


        if($num_changed_streams  === 0) continue;
        if (false === $num_changed_streams) {
            /* Error handling */
            var_dump($read);
            echo "Continue\n";
            die;
        } elseif ($num_changed_streams > 0) {
            echo "\r";
            $data = fread($socket, 4096);
            if($data !== "") 
             echo "<<< $data";        

            $data2 = fread(STDIN, 4096);

            if($data2 !== "") {
                if($data == 'exit') {
                    return;
                }
                echo ">>> $data2";
                fwrite($socket, trim($data2));
            }

            
        }

        } while(true);
    }
}
