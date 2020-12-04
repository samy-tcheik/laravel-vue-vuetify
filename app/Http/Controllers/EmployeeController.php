<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // populate Employees datatable
    public function getEmployees() {
        $employees = Employee::all()->toArray();
        return $employees;
    }
}
