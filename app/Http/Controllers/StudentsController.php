<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;

class StudentsController extends Controller
{
   public function index($BranchId){
      $studentData = student::where('BranchId', $BranchId)
      ->select('*')
      ->get();
  
      return view('student.students', compact('studentData', 'BranchId'));
   }
   public function create($BranchId)
   {
      return view('student.create', compact('BranchId'));
   }
   public function store(Request $request)
{
    // Create the student record
    student::create([
        'Name' => $request->Name,
        'Course_Name' => $request->Course_Name,
        'Age' => $request->Age,
        'NIC_Number' => $request->NIC_Number,
        'BranchId' => $request->BranchId,
    ]);

    return redirect()->route('students.index', ['BranchId' => $request->BranchId]);
}
public function destroy($id, $BranchId)
{
    // Find the student by ID
    $student = Student::find($id);

    // If the student exists, delete it
    if ($student) {
        $student->delete();
        return redirect()->route('students.index', ['BranchId' => $BranchId])
                         ->with('success', 'Student record deleted successfully!');
    }

    return redirect()->route('students.index', ['BranchId' => $BranchId])
                     ->with('error', 'Student not found!');
}
}
