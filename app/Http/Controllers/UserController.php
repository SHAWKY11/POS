<?php

namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('can:read' )->only('index');
        $this->middleware('can:create')->only('create');
        $this->middleware('can:update')->only(['update','edit']);
        $this->middleware('can:delete')->only('destroy');
    }

    public function index(Request $request)
    {
       $users = User::all();
      
        return view('dashboard.users.index',compact('users'));
     
        
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('dashboard.users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        if($request->file('image')){
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            $image->resize(215,215);
            $image->save(public_path('uploads/user_images/' .$request->file('image')->hashName()));
           
            $input['image']= $request->image->hashName();
        }//End of if
    
        $user = User::create($input);
        $user->syncPermissions($request->input('roles_name'));
    
        return redirect('users');
        session()->flash('success','added_successfully');

    }
    
    public function show($id)
    {
        // $user = User::find($id);
        // return view('users.show',compact('user'));
    }
    
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('dashboard.users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $this->validate($request, [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'image'=>'image',
            'roles_name' => 'required|min:1'

        ]);
    
        $input = $request->all();
        $user = User::find($id);

            if($request->file('image')){

            if($user->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
            } //end of inner if
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('image'));
            $image->resize(215,215);
            $image->save(public_path('uploads/user_images/' .$request->file('image')->hashName()));
            $input['image']= $request->image->hashName();
        }//End of external if
        
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->syncPermissions($request->input('roles_name'));
    
        return redirect('users');
        session()->flash('success','User updated successfully');
    }
    
    public function destroy(User $user)
    {
        if ($user->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/user_images/' . $user->image);

        }//end of if

        $user->delete();
        session()->flash('success', 'deleted_successfully');
        return redirect('users');

    }//end of destroy
}