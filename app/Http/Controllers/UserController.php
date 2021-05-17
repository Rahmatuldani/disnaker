<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array(
            'user' => User::find($id),
        );

        return view('profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user = User::find($id);
        $user->name = $request['name'];
        $user->address = $request['address'];
        $user->phone = $request['phone'];
        $user->save();

        return redirect()->route('user.show', $id)->with('message', 'Edit Profile Successful!');
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

    public function ChangePhoto(Request $request, $id)
    {
        $file = $request->file('cPhoto');
        $user = User::find($id);

        // Generate a file name with extension
        $fileName = $user->nip.'.'.$file->getClientOriginalExtension();

        // Save the file
        $path = $file->storeAs('public/images', $fileName);

        $user->photo = $fileName;
        $user->save();
        return redirect()->route('user.show', $id)->with('message', 'Change Photo Successful!');
    }

    public function changePassword(Request $request, $id = NULL)
    {
        if ($id == NULL) {
            return view('changePass');
        }

        $validated = $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        if (!$validated) {
            return redirect()->route('user.cpass');
        }

        $user = User::find($id);
        $user->password = Hash::make($request['confirm_password']);
        $user->save();

        Auth::logout();
        return redirect()->route('login')->with('message', 'Change Password Successful!');
    }
}
