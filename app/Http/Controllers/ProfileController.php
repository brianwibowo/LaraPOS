<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $title = "My Profile";

        $item = User::findOrFail(Auth::user()->id);

        return view('pages.profile.index', [
            'title' => $title,
            'item' => $item
        ]);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'photo' => 'image',
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $id . ',id',
            'password' => $request->input('password') ? 'min:8' : ''
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile.index')
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

        return redirect()->route('profile.index')->with('success','Berhasil memperbarui profil');
    }
    public function destroy($id)
    {
        //
    }
}
