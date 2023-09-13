<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreValidationRequest ;
use App\LocalStudents;
use App\ForeignStudents;
use App\AllStudents;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    /* Home */
    public function home(Request $request)
    {
        $filter = $request->input('filter', 'allStudents');
        if($request->filter == 'localStudents'){
            $students = LocalStudents::get();
        }elseif($request->filter  == 'foreignStudents'){
            $students = ForeignStudents::get();
        }else{
            $localStudents = LocalStudents::get();
            $foreignStudents = ForeignStudents::get();
            $students = $localStudents->concat($foreignStudents);
        }
        return view('home', compact('students', 'filter'));
    }

    
    /* Create */
    public function create(StoreValidationRequest $request)
    {
        $request->validated();

        $studentType = request('student_type');
        
        if ($studentType === 'local' || $studentType === 'foreign') {
            $student = $studentType === 'local' ? new LocalStudents() : new ForeignStudents();
            
            $student->student_type = $studentType;
            $student->id_number =$request->id_number;
            $student->name = $request->name;
            $student->age = $request->age;
            $student->gender = $request->gender;
            $student->city = $request->city;
            $student->mobile_number = $request->mobile_number;
            $student->grades = $request->grades;
            $student->email = $request->email;
            $student->save();
        
            $allStudents = new AllStudents();
            $allStudents->student_type = $studentType;
            if ($studentType === 'local') {
                $allStudents->local_student_id = $student->id;
            } elseif ($studentType === 'foreign') {
                $allStudents->foreign_student_id = $student->id;
            }
            
            $allStudents->save();
            return redirect()->route('home')->with('success', 'data created successfully');
        }
        
   
    }

    /* view page */
    public function createView()
    {
        return view('create');
    }

    /* Edit */
    public function edit($student_type, $id)
    {
        $Students = ($student_type == 'local') ? LocalStudents::findOrFail($id) : ForeignStudents::findOrFail($id);
        return view('edit', compact('Students'));
        
    }

    /* Update*/
    public function update($id , $student_type , StoreValidationRequest $request)
    {
        $request->validated();

        if ($student_type == 'local') {

            $Students = LocalStudents::findOrFail($id);
            if ($request->student_type != 'local' ) {
                $Students->delete();
                $ForeignStudents =  ForeignStudents::create($request->all());
                $AllStudents = new AllStudents();
                $AllStudents->student_type =  $request->student_type;
                $AllStudents->student_type == 'foreign' ? $AllStudents->foreign_student_id = $ForeignStudents->id : '';
                $AllStudents->save();
                } 
                else {
                    $Students->update($request->all());
            }
            
        }
        else {
            $request->validated();
                
            $Students = ForeignStudents::findOrFail($id);

            if ($request->student_type != 'foreign' ) {
                $Students->delete();
                $LocalStudents =  LocalStudents::create($request->all());
                $AllStudents = new AllStudents();
                $AllStudents->student_type =   $request->student_type;
                $AllStudents->student_type == 'local' ? $AllStudents->local_student_id = $LocalStudents->id : '';
                $AllStudents->save();
            }

            else{
                $Students->update($request->all());
            }
      }
        return redirect()->route('home') ->with('success', 'data updated successfully');
    }

    
    /* delete */
    public function delete(Request $request)
    {
      $Students = ($request->student_type == 'local') ? LocalStudents::findOrFail($request->id) : ForeignStudents::findOrFail($request->id);
      $Students->delete();
     return redirect()->route('home')->with('success', 'data deleted successfully');

    }
    
}