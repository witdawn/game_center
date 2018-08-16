<?php

namespace App\Console\Commands;

use App\Exports\PhoneExport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ExportPhones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export_phones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '导出手机号';

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
        $date = date('Y-m-d');
        $path = '/phone_excel/' . $date . '.xlsx';
        Excel::store(new PhoneExport, $path, 'local');
    }
}
