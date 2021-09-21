<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Employee;
use App\Mail\EmployeeRegistration;
use Mail;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    
    {
        
        $employees = Employee::all();
        return view('employee.list', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designation = Designation::all();
        return view('employee.add', compact('designation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employees'],
            'photo' => ['mimes:jpg,png,jpeg|max:5120'],
            'designation' => ['required'],
        ]);      

        
        if(!empty($request->photo)){

            $image_name = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images'), $image_name);
        } else{
            $image_name = '';
        }
        $email = $request->email;
        $employee = new Employee;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->designation_id = $request->designation;
        $employee->photo = $image_name;
        $password = \Str::random(12);
        $employee->password = $password;
        $employee->save();

        $data['password'] = $password;
        $data['user_name'] = $request->name;
        $data['email'] = $request->email;
        
        Mail::send('email.register', compact('data'), function($message) use ($data) {
            $message->to($data['email'], $data['user_name'])
            ->subject('Employee Registration');
        });

        return redirect()->route('employee.index')
                         ->with('success', 'Marks added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        $designations = Designation::all();
        return view('employee.edit', compact('employee', 'designations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {       
        /*request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'designation' => ['required'],
        ]);  */
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'photo' => ['mimes:jpg,png,jpeg,gif,svg|max:5120'],
        ]); 
        // dd("test");
        
        if($request->file()) {
            if( $employee->photo !== '') {
                /*Delete Current Image*/
                $image = $employee->photo;
                unlink("images/".$image);
            }
             /*Save new image*/
                $image_name = time().'.'.$request->photo->extension();
                $request->photo->move(public_path('images'), $image_name);
        } else {
            $image_name ='';
        }
// dd($request);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->designation_id = $request->designation;
        $employee->photo = $image_name;
        $employee->save();
        return redirect()->route('employee.index')
                         ->with('success', 'Profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employee.index')
                         ->with('deleted', 'Profile deleted successfully');
    }
}
