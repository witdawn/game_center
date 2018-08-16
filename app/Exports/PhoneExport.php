<?php
/**
 * Created by PhpStorm.
 * User: an
 * Date: 18-8-16
 * Time: 上午9:52
 */

namespace App\Exports;

use App\Models\Others\Phone;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;

class PhoneExport implements FromCollection
{
    public function collection()
    {
        $carbon=new Carbon();
        $selects=['phone','address','brand','type','code','created_at'];
        $start_at=$carbon->subDay(7)->startOfDay();
        return Phone::where('created_at','>=',$start_at)->select($selects)->get();
    }
}