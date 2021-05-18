<?php

namespace App\Http\Controllers;

use App\Models\IPK1;
use App\Models\IPK1Name;
use App\Models\Office;
use App\Models\Position;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PDF;

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
        $office = Office::where('office_name', $request['office_id'])->first();
        $position = Position::where('position_name', $request['position_id'])->first();

        $user = new User;
        $user->nip = $request['nip'];
        $user->name = $request['nip'];
        $user->password = Hash::make($request['nip']);
        $user->photo = 'user.png';
        $user->role = 'user';
        $user->office_id = $office->office_id;
        $user->position_id = $position->position_id;
        $user->save();

        return redirect()->route('admin.users')->with('message', 'Add User Successful!');
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
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.users')->with('message', 'Delete User Successful!');
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

    public function ipk1(Request $request, $action = null)
    {
        if ($action == null) {
            if ($request['month'] == null) {
                $request['month'] = date('Y-m');
            }
            // $time = substr($month, 5, 2);
            $data = array(
                'ipk' => IPK1::join('ipk1_names', 'ipk1_names.ipk1_name_id', '=', 'ipk1s.ipk1_name_id')
                                ->where('ipk1_month', $request['month'])
                                ->get(),
                'month' => $request['month'],
            );
            return view('laporan.ipk1', $data);
        } else if ($action == 'edit') {
            $ipk = IPK1::find($request['ipk1_id']);

            $ipk['15-19l'] = $request['15-19l'];
            $ipk['15-19p'] = $request['15-19p'];
            $ipk['20-29l'] = $request['20-29l'];
            $ipk['20-29p'] = $request['20-29p'];
            $ipk['30-44l'] = $request['30-44l'];
            $ipk['30-44p'] = $request['30-44p'];
            $ipk['45-54l'] = $request['45-54l'];
            $ipk['45-54p'] = $request['45-54p'];
            $ipk['55l'] = $request['55l'];
            $ipk['55p'] = $request['55p'];
            $ipk->save();

            return redirect()->route('user.ipk1');
        } else {
            $each = IPK1Name::all();

            foreach ($each as $e) {
                $ipk = new IPK1;
                $ipk['ipk1_name_id'] = $e['ipk1_name_id'];
                $ipk['ipk1_month'] = $request['month'];
                $ipk->save();
            }
            return redirect()->route('user.ipk1');
        }
    }

    public function print(Request $request, $set = 'portrait')
    {
        $data = IPK1::all();

        $pdf = PDF::loadView('print.ipk1', $data)->setPaper('a4', $set);

        // download PDF file with download method
        return $pdf->stream('Laporan_IPK_III/1_'.$request['month'].'.pdf');
    }
}
