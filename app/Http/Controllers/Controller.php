<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Companie;
use App\Models\Employee;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function ViewCompanyPage(){
        $companie = Companie::paginate(10);
        return view('companie', compact('companie'));
    }
    public static function ViewEmployeePage(){
        $employee = Employee::paginate(10);
        return view('employee', compact('employee'));
    }
}
