<?php

namespace App\Http\Controllers;
use App\Models\Room;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Salary;
use App\Models\Booking;
use App\Models\Contact;

use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function index(){
        if(Auth::id()){
            if(Auth::user()->usertype=='user'){
                $room =Room::all();
                return view('home.index',compact('room'));
            }else if(Auth::user()->usertype=='admin') {
                return view('admin.home');
            }elseif(Auth::user()->usertype== 'receptionist') { 
                 return view('receptionist.home');

            }
        }else {
            return redirect()->back();
        }
    }
    public function create_room(){
        return view('admin.create_room');
    }
    public function home(){
        $room =Room::all();
        return view('home.index',compact('room'));
    }
    public function add_room(Request $request)
    {
        $data = new Room;
        $data->room_number = $request->room_number;
        $data->room_title = $request->room_title;
        $data->description = $request->description;
        $data->room_type = $request->room_type;
        $data->price_per_night = $request->price_per_night;
        $data->status = $request->status;
        
        // Handle image upload
        $images = $request->file('images');
        if ($images) {
            $imagename = time() . '.' . $images->getClientOriginalExtension();
            $request->images->move('room', $imagename);
            $data->images = $imagename;
        }
        
        // Save the data to the database
        $data->save();
        
        // Return a success response with the created room data
        return redirect()->back()->with('success', 'Room added successfully!');
        dd($request->all());
    }
    public function view_room(){
        $data = Room::with('bookings')->get(); // loads related bookings
        return view('admin.view_room', compact('data'));
    }
    
        public function room_delete($id){
            $data =Room::find($id);
            $data->delete();
            return redirect()->back();
    
        }
        public function room_update($id){
            $data = Room::find($id);
            return view('admin.update_room',compact('data'));
          
        }
        public function edit_room(Request $request,$id){
            $data = Room::find($id);
            $data->room_number = $request->room_number;
            $data->room_title = $request->room_title;
            $data->description = $request->description;
            $data->room_type = $request->room_type;
            $data->price_per_night = $request->price_per_night;
            $data->status = $request->status;
            $images = $request->file('images');
            if ($images) {
                $imagename = time() . '.' . $images->getClientOriginalExtension();
                $request->images->move('room', $imagename);
                $data->images = $imagename;
            }
            $data->save();
            return redirect()->back()->with('success', 'Room updated successfully!');
        }
        public function manage_employee(){
            return view('admin.manage_employee');
        }
        
        public function add_employee(Request $request)
{
    $employee = new Employee;

    $employee->first_name = $request->first_name;
    $employee->last_name = $request->last_name;
    $employee->email = $request->email;
    $employee->phone = $request->phone;
    $employee->address = $request->address;
    $employee->hire_date = $request->hire_date;
    $employee->department = $request->department;
    $employee->role = $request->role;
    $employee->employment_status = $request->employment_status;

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        $image = $request->file('profile_picture');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('employee_profiles'), $imageName);
        $employee->profile_picture = $imageName; // match the actual DB column name
    }
    
    

    $employee->save();

    return redirect()->back()->with('success', 'Employee added successfully!');
}

        
        
public function view_employee(Request $request)
{
    $query = Employee::query();

    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('first_name', 'like', "%$search%")
              ->orWhere('last_name', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('role', 'like', "%$search%")
              ->orWhere('department', 'like', "%$search%");
        });
    }

    $data = $query->paginate(10); // Use pagination

    return view('admin.view_employee', compact('data'));
}

        public function employee_delete($id){
            $data =Employee::find($id);
            $data->delete();
            return redirect()->back();
    
        }
        public function employee_update($id){
            $data = Employee::find($id);
            return view('admin.update_employee',compact('data'));
          
        }
        public function edit_employee(Request $request,$id){
            $data = Employee::find($id);
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->hire_date = $request->hire_date;
            $data->employment_status = $request->employment_status;
            $data->role = $request->role;
            $data->department = $request->department;
            $image = $request->file('profile_picture');
            if ($image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('employee_profiles'), $imageName);
                $data->profile_picture = $imageName;
            }
            
            $data->save();
            return redirect()->back()->with('success', 'employee updated successfully!');
        }
        public function showAddSalaryForm()
        {
            // Pass 'employees' to the view
            $employees = \App\Models\Employee::all();
            return view('admin.add_salary', compact('employees'));
        }
        
        public function storeSalary(Request $request)
        {
            // Validate the incoming request data
            $request->validate([
                'employee_id' => 'required|exists:employees,id',
                'amount' => 'required|numeric',
                'payment_date' => 'required|date',
            ]);
        
            // Use only validated data for the creation of a new salary record
            $salaryData = $request->only(['employee_id', 'amount', 'payment_date']);
        
            // Create the salary record in the database
            \App\Models\Salary::create($salaryData);
        
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Salary record added successfully!');
        }
        
public function viewSalaries()
{
    $salaries = Salary::with('employee')->get();
    return view('admin.salaries', compact('salaries'));
}
public function room_details($id){
    $room = Room::find($id);
    
    return view ('home.room_details',compact('room'));

}
        public function view_reservations(){
            $data=Booking::all();
return view('admin.view_reservations',compact('data'));
        }
        public function delete_booking($id) {
            $data = Booking::find($id);
            if ($data) {
                $data->delete();
                return redirect()->back()->with('success', 'Booking deleted successfully');
            } else {
                return redirect()->back()->with('error', 'Booking not found');
            }
        }
        public function approve_book($id) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
             $booking = Booking::find($id);
             $booking-> status= 'approve';
             $booking-> save();
            return redirect ()->back();
    } 
        public function reject_book($id){
        
         $booking = Booking::find($id);
         $booking-> status= 'rejected';
         $booking-> save();
    return redirect ()->back();
    }
    public function contact(Request $request)
    {
        // Save the contact data
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->save();
    
        // Redirect back to the previous page
        return redirect()->back()->with('success', 'Your message has been sent!');
    }
    public function all_messages(){
        $data = Contact::all();
        return view('admin.all_messages',compact('data'));
    }

    public function showServices()
    {
        $user = auth()->user();
    
        // You could filter services only for guests that are checked-in, if needed
        $services = \App\Models\AlternativeService::where('guest_id', $user->id)->get();
    
        return view('home.services', compact('services'));
    }
    


    }
  
    