<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Post;
use DateTime;
use Illuminate\Http\Request;
use SebastianBergmann\Diff\Diff;

class EmployeeController extends Controller
{
    // populate Employees datatable
    public function getEmployees() {
        $employees = Employee::with('post')->get()->toArray();

        foreach ($employees as $employee) {
            $birth = new DateTime($employee['date_birth']);
            $today = new DateTime();
            $age = $today->diff($birth);
            $employee['post'] = $employee['post']['name'];
            $employee['date_birth'] = $age->y ;
            $emplData[] = $employee;
        }
        
        return $emplData;
    }

    //Store new employee
    public function storeEmpl(Request $request) {
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'address' => 'required',
            'birth' => 'required',
            'post' => 'required'
        ]);

        $post = Post::where('name', $request->input('post'))->first();

        Employee::create([
            'last_name' => $request->input('last_name'),
            'first_name' => $request->input('first_name'),
            'date_birth' => $request->input('birth'),
            'post_id' => $post->id,
            'address' => $request->input('address'),
            'recru' => $request->input('recru'),
        ]);
    }
}
