<?php

namespace App\Http\Controllers;

use App\Exports\IPK1Export;
use App\Models\BusinessField;
use App\Models\Education;
use App\Models\IPK1;
use App\Models\IPK1Name;
use App\Models\IPK2;
use App\Models\IPK3;
use App\Models\IPK4;
use App\Models\IPK5;
use App\Models\IPK6;
use App\Models\JobPosition;
use App\Models\Office;
use App\Models\Town;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PDF;
use Excel;
use DB;

class UserController extends Controller
{
    public function check($string)
    {
        while (strlen($string) < 4) {
            $string = '0'.$string;
        }
        return $string;
    }

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

        $user = new User;
        $user->username = $request['username'];
        $user->name = $request['username'];
        $user->password = Hash::make($request['username']);
        $user->photo = 'user.png';
        $user->role = $request['role'];
        $user->office_id = $office['office_id'];
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

    public function print(Request $request)
    {
        $office = Office::find(Auth::user()->office_id);
        $town = Town::find($office['town_id']);
        if ($request['jenisCetak'] == 'excel') {
            if ($request['type'] == 'ipk1') {
                return Excel::download(new IPK1Export($town->town_id, $request['month']), 'ipk1-'.$request['month'].'.xlsx');
            }
        } else {
            if ($request['type'] == 'ipk1') {
                $data = array(
                    'ipk' => IPK1::join('ipk1_names', 'ipk1_names.ipk1_name_id', '=', 'ipk1s.ipk1_name_id')
                                    ->where('ipk1_month', $request['month'])
                                    ->where('town_id', $town['town_id'])
                                    ->get(),
                    'month' => $request['month'],
                );
                $pdf = PDF::loadView('pdf.invoice', $data);
                return $pdf->stream('ipk1-'.$request['month'].'pdf');
            }
        }
    }

    public function ipk1(Request $request, $action = null)
    {
        $office = Office::find(Auth::user()->office_id);
        $town = Town::find($office['town_id']);
        if ($action == null) {
            if ($request['month'] == null) {
                $request['month'] = date('Y-m');
            }
            $data = array(
                'ipk' => IPK1::join('ipk1_names', 'ipk1_names.ipk1_name_id', '=', 'ipk1s.ipk1_name_id')
                                ->where('ipk1_month', $request['month'])
                                ->where('town_id', $town['town_id'])
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
            $check = IPK1::where('ipk1_month', $request['month'])
                            ->where('town_id', $town['town_id'])->first();

            if ($check == null) {
                $each = IPK1Name::all();
                foreach ($each as $e) {
                    $ipk = new IPK1;
                    $ipk['ipk1_name_id'] = $e['ipk1_name_id'];
                    $ipk['ipk1_month'] = $request['month'];
                    $ipk['town_id'] = $town['town_id'];
                    $ipk->save();
                }
            }

            return redirect()->route('user.ipk1');
        }
    }

    public function ipk2(Request $request, $action = null)
    {
        $office = Office::find(Auth::user()->office_id);
        $town = Town::find($office['town_id']);
        if ($action == null) {
            if ($request['month'] == null) {
                $request['month'] = date('Y-m');
            }
            $data = array(
                'ipk' => IPK2::join('educations', 'educations.education_id', '=', 'ipk2s.education_id')
                                ->where('ipk2_month', $request['month'])
                                ->where('town_id', $town['town_id'])
                                ->get(),
                'month' => $request['month'],
            );
            return view('laporan.ipk2', $data);
        } else if ($action == 'edit') {
            $ipk = IPK2::find($request['ipk2_id']);
            $ipk->rest_last_month_l = $request['rest_last_month_l'];
            $ipk->rest_last_month_p = $request['rest_last_month_p'];
            $ipk->registered_this_month_l = $request['registered_this_month_l'];
            $ipk->registered_this_month_p = $request['registered_this_month_p'];
            $ipk->placement_this_month_l = $request['placement_this_month_l'];
            $ipk->placement_this_month_p = $request['placement_this_month_p'];
            $ipk->deleted_this_month_l = $request['deleted_this_month_l'];
            $ipk->deleted_this_month_p = $request['deleted_this_month_p'];
            $ipk->rest_this_month_l = $request['rest_this_month_l'];
            $ipk->rest_this_month_p = $request['rest_this_month_p'];
            $ipk->save();

            return redirect()->route('user.ipk2');
        } else {
            $check = IPK2::where('ipk2_month', $request['month'])
                            ->where('town_id', $town['town_id'])->first();

            if ($check == null) {
                $each = Education::all();
                foreach ($each as $e) {
                    $ipk = new IPK2;
                    $ipk['education_id'] = $e['education_id'];
                    $ipk['ipk2_month'] = $request['month'];
                    $ipk['town_id'] = $town['town_id'];
                    $ipk->save();
                }
            }

            return redirect()->route('user.ipk2');
        }
    }

    public function ipk3(Request $request, $action = null)
    {
        $office = Office::find(Auth::user()->office_id);
        $town = Town::find($office['town_id']);
        if ($action == null) {
            if ($request['month'] == null) {
                $request['month'] = date('Y-m');
            }
            $data = array(
                'ipk' => IPK3::join('job_positions', 'job_positions.job_position_id', '=', 'ipk3s.job_position_id')
                                ->where('ipk3_month', $request['month'])
                                ->where('town_id', $town['town_id'])
                                ->get(),
                'month' => $request['month'],
            );
            return view('laporan.ipk3', $data);
        } else if ($action == 'edit') {
            $ipk = IPK3::find($request['ipk3_id']);
            $ipk->rest_last_month_l = $request['rest_last_month_l'];
            $ipk->rest_last_month_p = $request['rest_last_month_p'];
            $ipk->registered_this_month_l = $request['registered_this_month_l'];
            $ipk->registered_this_month_p = $request['registered_this_month_p'];
            $ipk->placement_this_month_l = $request['placement_this_month_l'];
            $ipk->placement_this_month_p = $request['placement_this_month_p'];
            $ipk->deleted_this_month_l = $request['deleted_this_month_l'];
            $ipk->deleted_this_month_p = $request['deleted_this_month_p'];
            $ipk->rest_this_month_l = $request['rest_this_month_l'];
            $ipk->rest_this_month_p = $request['rest_this_month_p'];
            $ipk->save();

            return redirect()->route('user.ipk3');
        } else {
            $check = IPK3::where('ipk3_month', $request['month'])
                            ->where('town_id', $town['town_id'])->first();

            if ($check == null) {
                $each = JobPosition::all();
                foreach ($each as $e) {
                    $ipk = new IPK3;
                    $ipk['job_position_id'] = $e['job_position_id'];
                    $ipk['ipk3_month'] = $request['month'];
                    $ipk['town_id'] = $town['town_id'];
                    $ipk->save();
                }
            }

            return redirect()->route('user.ipk3');
        }
    }

    public function ipk4(Request $request, $action = null)
    {
        $office = Office::find(Auth::user()->office_id);
        $town = Town::find($office['town_id']);
        if ($action == null) {
            if ($request['month'] == null) {
                $request['month'] = date('Y-m');
            }
            $data = array(
                'ipk' => IPK4::join('educations', 'educations.education_id', '=', 'ipk4s.education_id')
                                ->where('ipk4_month', $request['month'])
                                ->where('town_id', $town['town_id'])
                                ->get(),
                'month' => $request['month'],
            );
            return view('laporan.ipk4', $data);
        } else if ($action == 'edit') {
            $ipk = IPK4::find($request['ipk4_id']);
            $ipk->rest_last_month_l = $request['rest_last_month_l'];
            $ipk->rest_last_month_p = $request['rest_last_month_p'];
            $ipk->registered_this_month_l = $request['registered_this_month_l'];
            $ipk->registered_this_month_p = $request['registered_this_month_p'];
            $ipk->placement_this_month_l = $request['placement_this_month_l'];
            $ipk->placement_this_month_p = $request['placement_this_month_p'];
            $ipk->deleted_this_month_l = $request['deleted_this_month_l'];
            $ipk->deleted_this_month_p = $request['deleted_this_month_p'];
            $ipk->rest_this_month_l = $request['rest_this_month_l'];
            $ipk->rest_this_month_p = $request['rest_this_month_p'];
            $ipk->save();

            return redirect()->route('user.ipk4');
        } else {
            $check = IPK4::where('ipk4_month', $request['month'])
                            ->where('town_id', $town['town_id'])->first();

            if ($check == null) {
                $each = Education::all();
                foreach ($each as $e) {
                    $ipk = new IPK4;
                    $ipk['education_id'] = $e['education_id'];
                    $ipk['ipk4_month'] = $request['month'];
                    $ipk['town_id'] = $town['town_id'];
                    $ipk->save();
                }
            }

            return redirect()->route('user.ipk4');
        }
    }

    public function ipk5(Request $request, $action = null)
    {
        $office = Office::find(Auth::user()->office_id);
        $town = Town::find($office['town_id']);
        if ($action == null) {
            if ($request['month'] == null) {
                $request['month'] = date('Y-m');
            }
            $data = array(
                'ipk' => IPK5::join('job_positions', 'job_positions.job_position_id', '=', 'ipk5s.job_position_id')
                                ->where('ipk5_month', $request['month'])
                                ->where('town_id', $town['town_id'])
                                ->get(),
                'month' => $request['month'],
            );
            return view('laporan.ipk5', $data);
        } else if ($action == 'edit') {
            $ipk = IPK5::find($request['ipk5_id']);
            $ipk->rest_last_month_l = $request['rest_last_month_l'];
            $ipk->rest_last_month_p = $request['rest_last_month_p'];
            $ipk->registered_this_month_l = $request['registered_this_month_l'];
            $ipk->registered_this_month_p = $request['registered_this_month_p'];
            $ipk->placement_this_month_l = $request['placement_this_month_l'];
            $ipk->placement_this_month_p = $request['placement_this_month_p'];
            $ipk->deleted_this_month_l = $request['deleted_this_month_l'];
            $ipk->deleted_this_month_p = $request['deleted_this_month_p'];
            $ipk->rest_this_month_l = $request['rest_this_month_l'];
            $ipk->rest_this_month_p = $request['rest_this_month_p'];
            $ipk->save();

            return redirect()->route('user.ipk5');
        } else {
            $check = IPK5::where('ipk5_month', $request['month'])
                            ->where('town_id', $town['town_id'])->first();

            if ($check == null) {
                $each = JobPosition::all();
                foreach ($each as $e) {
                    $ipk = new IPK5;
                    $ipk['job_position_id'] = $e['job_position_id'];
                    $ipk['ipk5_month'] = $request['month'];
                    $ipk['town_id'] = $town['town_id'];
                    $ipk->save();
                }
            }

            return redirect()->route('user.ipk5');
        }
    }

    public function ipk6(Request $request, $action = null)
    {
        $office = Office::find(Auth::user()->office_id);
        $town = Town::find($office['town_id']);
        if ($action == null) {
            if ($request['month'] == null) {
                $request['month'] = date('Y-m');
            }
            $data = array(
                'ipk' => IPK6::join('business_fields', 'business_fields.business_field_id', '=', 'ipk6s.business_field_id')
                                ->where('ipk6_month', $request['month'])
                                ->where('town_id', $town['town_id'])
                                ->get(),
                'month' => $request['month'],
            );
            return view('laporan.ipk6', $data);
        } else if ($action == 'edit') {
            $ipk = IPK6::find($request['ipk6_id']);
            $ipk->rest_last_month_l = $request['rest_last_month_l'];
            $ipk->rest_last_month_p = $request['rest_last_month_p'];
            $ipk->registered_this_month_l = $request['registered_this_month_l'];
            $ipk->registered_this_month_p = $request['registered_this_month_p'];
            $ipk->placement_this_month_l = $request['placement_this_month_l'];
            $ipk->placement_this_month_p = $request['placement_this_month_p'];
            $ipk->deleted_this_month_l = $request['deleted_this_month_l'];
            $ipk->deleted_this_month_p = $request['deleted_this_month_p'];
            $ipk->rest_this_month_l = $request['rest_this_month_l'];
            $ipk->rest_this_month_p = $request['rest_this_month_p'];
            $ipk->save();

            return redirect()->route('user.ipk6');
        } else {
            $check = IPK6::where('ipk6_month', $request['month'])
                            ->where('town_id', $town['town_id'])->first();

            if ($check == null) {
                $each = BusinessField::all();
                foreach ($each as $e) {
                    $ipk = new IPK6;
                    $ipk['business_field_id'] = $this->check($e['business_field_id']);
                    $ipk['ipk6_month'] = $request['month'];
                    $ipk['town_id'] = $town['town_id'];
                    $ipk->save();
                }
            }

            return redirect()->route('user.ipk6');
        }
    }

    // function importIPK1(Request $request)
    // {
    //     $this->validate($request, [
    //         'select_file'  => 'required|mimes:xls,xlsx'
    //     ]);

    //     $path = $request->file('select_file')->getRealPath();

    //     $data = Excel::load($path)->get();

    //     if($data->count() > 0)
    //     {
    //         foreach($data->toArray() as $key => $value)
    //         {
    //             foreach($value as $row)
    //             {
    //                 $insert_data[] = array(
    //                 '1' =>  $row['ipk1_name_id'],
    //                 '2' =>  $row['15-19l'],
    //                 '3' =>  $row['15-19p'],
    //                 '4' =>  $row['20-29l'],
    //                 '5' =>  $row['20-29p'],
    //                 '6' =>  $row['30-44l'],
    //                 '7' =>  $row['30-44p'],
    //                 '8' =>  $row['45-54l'],
    //                 '9' =>  $row['45-54p'],
    //                 '10' =>  $row['55l'],
    //                 '11' =>  $row['55p'],
    //                 );
    //             }
    //         }

    //         if(!empty($insert_data))
    //         {
    //             DB::table('ipk1s')->insert($insert_data);
    //         }
    //     }
    //  return back()->with('success', 'Excel Data Imported successfully.');
    // }
}
