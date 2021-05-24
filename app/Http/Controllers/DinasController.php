<?php

namespace App\Http\Controllers;

use App\Exports\IPK1Export;
use App\Models\Education;
use App\Models\IPK1;
use App\Models\IPK1Name;
use App\Models\IPK2;
use App\Models\IPK3;
use App\Models\IPK4;
use App\Models\IPK5;
use App\Models\IPK6;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Excel;

class DinasController extends Controller
{
    public function index()
    {
        return view('dinas.home');
    }

    public function show($id)
    {
        $data = array(
            'user' => User::join('offices', 'offices.office_id', '=', 'users.office_id')
                            ->join('towns', 'towns.town_id', '=', 'offices.town_id')
                            ->where('users.id', $id)
                            ->first(),
        );

        return view('dinas.profile', $data);
    }

    public function changePassword(Request $request, $id = NULL)
    {
        if ($id == NULL) {
            return view('dinas.changePass');
        }

        $validated = $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        if (!$validated) {
            return redirect()->route('dinas.cpass');
        }

        $user = User::find($id);
        $user->password = Hash::make($request['confirm_password']);
        $user->save();

        Auth::logout();
        return redirect()->route('login')->with('message', 'Change Password Successful!');
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request['name'];
        $user->address = $request['address'];
        $user->phone = $request['phone'];
        $user->save();

        return redirect()->route('dinas.show', $id)->with('message', 'Edit Profile Successful!');
    }

    public function ipk1(Request $request)
    {
        if ($request['month'] == null) {
            $request['month'] = date('Y-m');
        }
        $data = array(
            'ipk' => IPK1::join('ipk1_names', 'ipk1_names.ipk1_name_id', '=', 'ipk1s.ipk1_name_id')
                            ->where('ipk1_month', $request['month'])
                            ->groupBy('ipk1s.ipk1_name_id')
                            ->get(),
            'month' => $request['month'],
        );
        return view('dinas.laporan.ipk1', $data);
    }

    public function ipk2(Request $request)
    {
        if ($request['month'] == null) {
            $request['month'] = date('Y-m');
        }
        $data = array(
            'ipk' => IPK2::join('educations', 'educations.education_id', '=', 'ipk2s.education_id')
                            ->where('ipk2_month', $request['month'])
                            ->groupBy('ipk2s.education_id')
                            ->get(),
            'month' => $request['month'],
        );
        return view('dinas.laporan.ipk2', $data);
    }

    public function ipk3(Request $request)
    {
        if ($request['month'] == null) {
            $request['month'] = date('Y-m');
        }
        $data = array(
            'ipk' => IPK3::join('job_positions', 'job_positions.job_position_id', '=', 'ipk3s.job_position_id')
                            ->where('ipk3_month', $request['month'])
                            ->groupBy('ipk3s.job_position_id')
                            ->get(),
            'month' => $request['month'],
        );
        return view('dinas.laporan.ipk3', $data);
    }

    public function ipk4(Request $request)
    {
        if ($request['month'] == null) {
            $request['month'] = date('Y-m');
        }
        $data = array(
            'ipk' => IPK4::join('educations', 'educations.education_id', '=', 'ipk4s.education_id')
                            ->where('ipk4_month', $request['month'])
                            ->groupBy('ipk4s.education_id')
                            ->get(),
            'month' => $request['month'],
        );
        return view('dinas.laporan.ipk4', $data);
    }

    public function ipk5(Request $request, $action = null)
    {
        if ($request['month'] == null) {
            $request['month'] = date('Y-m');
        }
        $data = array(
            'ipk' => IPK5::join('job_positions', 'job_positions.job_position_id', '=', 'ipk5s.job_position_id')
                            ->where('ipk5_month', $request['month'])
                            ->groupBy('ipk5s.job_position_id')
                            ->get(),
            'month' => $request['month'],
        );
        return view('dinas.laporan.ipk5', $data);
    }

    public function ipk6(Request $request, $action = null)
    {
        if ($request['month'] == null) {
            $request['month'] = date('Y-m');
        }
        $data = array(
            'ipk' => IPK6::join('business_fields', 'business_fields.business_field_id', '=', 'ipk6s.business_field_id')
                            ->where('ipk6_month', $request['month'])
                            ->groupBy('ipk6s.business_field_id')
                            ->get(),
            'month' => $request['month'],
        );
        return view('dinas.laporan.ipk6', $data);
    }

    public function print(Request $request, $type)
    {
        if ($type == 'ipk1') {
            return Excel::download(new IPK1Export(2,2), 'ipk1.xlsx');
        }
    }
}
