<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Employee;
use Redirect;
use DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
class EmployeeController extends Controller
{
    public function index()
    {
        $data = Employee::latest()->paginate(3);
        return view('index', compact('data'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    public function create()
    {
        return view('create');
    }
    public function search(Request $request){
        $search=$request->get('search');
        $data=DB::table('employees')->where('nom','like','%'.$search.'%')->paginate(3);
        return view('index',['data'=>$data]);
             
    }
    public function store(Request $request)
    {
        $this->validate($request, [
                'nom'    =>  'required|',
                'prenom'     =>  'required|',
                'sexe'     =>  'required|',
                'email'     =>  'required|',
                'telephone'     =>  'required|',
                'image'         =>  'image|max:2048'
        ]);
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        $input_data = array(
            'nom'       =>   $request->nom,
            'prenom'        =>   $request->prenom,
            'sexe'        =>      $request->sexe,
            'email'        =>       $request->email,
            'telephone'        =>       $request->telephone,
            'image'            =>   $new_name
        );
        Employee::create($input_data);
        return redirect('employee')->with('Success', 'Employee Inserted Successfully');
    }
    
    public function edit($id)
    {
        $data = Employee::findOrFail($id);
        return view('edit', compact('data'));
    }
 
    public function update(Request $request, $id)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if($request->hasFile('image'))  
        {
            $this->validate($request, [
                'nom'    =>  'required|',
                'prenom'     =>  'required|',
                'sexe'     =>  'required|',
                'email'     =>  'required|',
                'telephone'     =>  'required|',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $filename = $image->getClientOriginalName();
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
        }
        else 
        {
            $this->validate($request, [
                'nom'    =>  'required|',
                'prenom'     =>  'required|',
                'sexe'     =>  'required|',
                'email'     =>  'required|',
                'telephone'     =>  'required|',
                
            ]);
            $input_data = array(
                'nom'       =>   $request->nom,
                'prenom'        =>   $request->prenom,
                'sexe'        =>      $request->sexe,
                'email'        =>       $request->email,
                'telephone'        =>       $request->telephone,
                'image'            =>   $image,
            );
        }
        Employee::whereId($id)->update($input_data);
        return redirect('employee')->with('Success', 'Employee Updated Successfully');
    }
    
    public function destroy($id) 
    {
        $data = Employee::findOrFail($id);
        $data->delete();
        return redirect('employee')->with('error', 'Employé a été supprimé avec succès ');
    }
}
