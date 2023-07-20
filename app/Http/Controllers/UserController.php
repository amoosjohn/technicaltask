<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserInterest;
use App\Models\Role;
use Carbon\Carbon;
use App\Jobs\SendRegisterEmailJob;



class UserController extends Controller
{
    /*
    * Homepage
    * @return view
    */
    public function index()
    {
        $interests = config('constants.interests');
        return view('users.index',compact('interests'));
    }

    /*
    * store
    * @return view
    */
    public function store(Request $request)
    {
        // Retrieve the validated input data...
        $data = $request->only(['name','email','password','interest']);

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:3|max:50',
            'interest' => 'required|array',
            'interest.*' => 'required|string'
        ],[
            'interest.*.required' => 'The interest field is required.'
        ]);

        if ($validator->fails()) {
           
            return redirect('/')
                        ->withErrors($validator->errors())
                        ->withInput();
        }


        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);
    
            //Save given interests for the user
            $interests = [];
            foreach($data['interest'] as $interest)
            {
                $interests[] = [
                    'user_id' => $user->id,
                    'interest' => $interest,
                    'created_at' => Carbon::now()
                ];
            }
    
            UserInterest::insert($interests);
            
           
            //Attaching all roles for the user
            $rolesIds = Role::get()->pluck('id')->toArray();
            $user->roles()->attach($rolesIds);
    
            //Dispatch email job
            $mail = $data['email'];
            dispatch(new SendRegisterEmailJob($mail));
    

            DB::commit();
            return redirect()->route('index')->with('success','User has been added successfully');

        } catch (\Exception $e) {
            DB::rollback();
            \Logs::debug($e);
            // something went wrong
            return redirect()->route('index')->with('system_error','Something went wrong! Please check with administrator');
        }

    }

    public function userList()
    {
        $users = User::with('roles','userInterests')->orderByDesc('id')->simplePaginate(10);

        return view('users.list',compact('users'));
    }
}
