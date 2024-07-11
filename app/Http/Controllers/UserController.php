<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\User;

use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        $title = "User List";

        $items = User::all();

        return view('pages.user.index', [
            'title' => $title,
            'items' => $items
        ]);
    }
    public function create()
    {
        $title = "Create New User";

        return view('pages.user.create', [
            'title' => $title
        ]);
    }
    public function store(UserRequest $request)
    {
        $photo = $request->file('photo');

        $data = $request->all();
        
        if ($photo){
            $data['photo'] = $photo->store(
                'assets/user', 'public'
            );
        }else{
            $data['photo'] = "";
        }

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('user.index')->with('success','User berhasil dibuat!');
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $title = "Edit User";

        $item = User::findOrFail($id);

        return view('pages.user.edit', [
            'title' => $title,
            'item' => $item
        ]);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'image',
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $id . ',id',
            'password' => $request->input('password') ? 'min:8' : ''
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.edit', $id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $photo = $request->file('photo');
        $password = $request->input('password');

        if ($password){
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
        }else{
            $data = $request->except('password');
        }
        
        if ($photo){
            $data['photo'] = $photo->store(
                'assets/user', 'public'
            );
        }

        User::findOrFail($id)->update($data);

        return redirect()->route('user.index')->with('success','User berhasil diperbarui!');
    }
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        
        return redirect()->route('user.index')->with('success','User berhasil dihapus!');
    }
}
