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

    //Store new employee
    public function storeEmpl(Request $request) {
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'address' => 'required',
            'birth_date' => 'required',
            'post' => 'required'
        ]);

        $employee = Employee::create([
            'last_name' => $request->input('last_name'),
            'first_name' => $request->input('first_name'),
            'date_birth' => $request->input('birth'),
            'address' => $request->input('adress'),
            'recru' => $request->input('recru'),
        ]);
        
    }
}
