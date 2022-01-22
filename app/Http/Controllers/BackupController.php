<?php

namespace App\Http\Controllers;

use App\Models\Backup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;


class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Artisan::call('db:backup');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function show(Backup $backup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function edit(Backup $backup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Backup $backup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Backup $backup)
    {
        //
    }

    public function manual_backup(Request $request)
    {
        // $host = "localhost";
        // $user = "root";
        // $pass = "";
        // $db = "inventory";
        // $mysqlpath = "C:\\xampp\\mysql\\bin\\mysqldump";

        // $filename = Carbon::now()->format('Y-m-d_H-i-s') . '.sql';
        // $file_path = "C:\\xampp\\htdocs\\inventory\\storage\\app\\backup\\".$filename;

        // try{
        //     $command = "$mysqlpath --user=".$user." --password=".$pass." --host=".$host." inventory > ".$file_path ."2>&1";
        //     shell_exec($command);

        // }catch(Exception $e){
        //     Log::info($e->errorInfo);
        //     return $e->errorInfo;
        // }
        
        Artisan::call('db:backup');
        return back()->with('success', 'Manual Backup Created Successfully');
    }
}
