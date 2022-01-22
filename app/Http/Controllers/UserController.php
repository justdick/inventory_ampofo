<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('all_users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:50',
            'username' => 'required|unique:users|min:4|max:15',
            'password' => 'required',
            'role' => 'required',
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return back()->with('success', 'User Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('edit_user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:50',
            'username' => 'required|min:4|max:15',
            'role' => 'required',
            'password' => 'sometimes',
        ]);

        $user = User::where('id', $id)->first();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->role = $data['role'];

        if($data['username'] != $user->username){
            $user->username = $data['username'];
        }

        if($data['password'] != ''){
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        return redirect()->route('user.index')->with('success', 'User Details Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
