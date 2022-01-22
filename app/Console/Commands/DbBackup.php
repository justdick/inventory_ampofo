<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Exception;

class DbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup Mysql Database';

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
        // dd(Carbon::now()->format('Y-m-d_H:i:s').'.sql');
        $filename = Carbon::now()->format('Y-m-d_H-i-s') . '.sql';
        $file_path = "C:\\xampp\\htdocs\\inventory\\storage\\app\\backup\\".$filename;
        //dd($file_path );

        try{
            $command = "C:\\xampp\\mysql\\bin\\mysqldump -u root inventory > ".$file_path;
            shell_exec($command);

        }catch(Exception $e){
            Log::info($e->errorInfo);
            return $e->errorInfo;
        }
        
        if (!file_exists("C:\Users\DELL\Downloads\backups")){
            mkdir("C:\Users\DELL\Downloads\backups");
        }

        if (!file_exists("C:\Users\DELL\Downloads\backups\\". Carbon::now()->format('Y-m-d'))){
            mkdir("C:\Users\DELL\Downloads\backups\\". Carbon::now()->format('Y-m-d'));
        }

        copy("C:\\xampp\\htdocs\\inventory\\storage\\app\\backup\\".$filename, "C:\Users\DELL\Downloads\backups\\". Carbon::now()->format('Y-m-d')."/".$filename);
    }
}
