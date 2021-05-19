<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\JobPosition;
use App\Models\Office;
use App\Models\Position;
use App\Models\Town;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PDOException;

class AdminController extends Controller
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
        return view('admin.home');
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
            'user' => User::join('offices', 'offices.office_id', '=', 'users.office_id')
                            ->join('towns', 'towns.town_id', '=', 'offices.town_id')
                            ->join('positions', 'positions.position_id', '=', 'users.position_id')
                            ->where('users.id', $id)
                            ->first(),
        );

        return view('admin.profile', $data);
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

        return redirect()->route('admin.show', $id)->with('message', 'Edit Profile Successful!');
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

    public function changePassword(Request $request, $id = NULL)
    {
        if ($id == NULL) {
            return view('admin.changePass');
        }

        $validated = $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        if (!$validated) {
            return redirect()->route('admin.cpass');
        }

        $user = User::find($id);
        $user->password = Hash::make($request['confirm_password']);
        $user->save();

        Auth::logout();
        return redirect()->route('login')->with('message', 'Change Password Successful!');
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
        return redirect()->route('admin.show', $id)->with('message', 'Change Photo Successful!');
    }

    public function Users(Request $request)
    {
        $data = array(
            'user' => User::join('offices', 'offices.office_id', '=', 'users.office_id')
                            ->join('positions', 'positions.position_id', '=', 'users.position_id')
                            ->get(),
            'office' => Office::all(),
            'position' => Position::all(),
        );
        return view('admin.addUser', $data);
    }

    public function Position(Request $request, $action = null)
    {
        if ($action == null) {
            $data = array(
                'position' => Position::all(),
            );
            return view('admin.position', $data);
        } else if ($action == 'add') {
            $position = new Position;
            $position->position_name = $request['position_name'];
            $position->save();

            return redirect()->route('admin.position')->with('message', 'Add Position Successful!');
        } else if ($action == 'delete') {
            $position = Position::find($request['position_id']);
            try {
                $position->delete();
            } catch (\PDOException $e) {
                return redirect()->route('admin.position')->with('message', "Cannot delete this position!");
            }

            return redirect()->route('admin.position')->with('message', 'Delete Position Successful!');
        }
    }

    public function Office(Request $request, $action = null)
    {
        if ($action == null) {
            $data = array(
                'office' => Office::join('towns', 'towns.town_id', '=', 'offices.town_id')->get(),
                'town' => Town::all(),
            );
            return view('admin.office', $data);
        } else  if ($action == 'delete') {
            $office = Office::find($request['office_id']);
            $office->delete();

            return redirect()->route('admin.office')->with('message', 'Delete Office Successful!');
        } else {
            $town_name = explode(" ", $request['town_id']);
            $town = Town::where('town_name', $town_name[1])->first();

            if ($action == 'add') {
                $office = new Office;
                $office->office_name = $request['office_name'];
                $office->office_address = $request['office_address'];
                $office->office_phone = $request['office_phone'];
                $office->town_id = $town['town_id'];
                $office->save();

                return redirect()->route('admin.office')->with('message', 'Add Office Successful!');
            } else if ($action == 'edit') {
                $office = Office::find($request['office_id']);
                $office->office_name = $request['office_name'];
                $office->office_address = $request['office_address'];
                $office->office_phone = $request['office_phone'];
                $office->town_id = $town['town_id'];
                $office->save();
                return redirect()->route('admin.office')->with('message', 'Edit Office Successful!');
            }
        }
    }

    public function userRegion()
    {
        $label = [];
        $data = [];

        $town = Town::all();
        foreach ($town as $t ) {
            array_push($label, $t['town_slug'].' '.$t['town_name']);
            array_push($data, User::join('offices', 'offices.office_id', '=', 'users.office_id')->where('town_id', $t['town_id'])->count());
        }

        $array = array(
            'label' => $label,
            'count' => $data,
            'max' => User::all()->count(),
        );
        return $array;
    }

    public function userPosition()
    {
        $label = [];
        $data = [];

        $position = Position::all();
        foreach ($position as $t ) {
            array_push($label, $t['position_name']);
            array_push($data, User::join('positions', 'positions.position_id', '=', 'users.position_id')->where('users.position_id', $t['position_id'])->count());
        }

        $array = array(
            'label' => $label,
            'count' => $data,
            'max' => User::all()->count(),
        );
        return $array;
    }

    public function education(Request $request, $action = null)
    {
        if ($action == null) {
            $data = array(
                'education' => Education::all(),
            );
            return view('admin.education', $data);
        } else if ($action == 'add'){
            $edu = new Education;
            try {
                $edu->education_id = $request['education_id'];
                $edu->education_name = Str::upper($request['education_name']);
                $edu-> save();
            } catch (\Throwable $th) {
                return redirect()->route('admin.education')->with('message', 'Cannot Add Education Field!');
            }

            return redirect()->route('admin.education')->with('message', 'Add Education Field Successful!');
        } else if ($action == 'delete'){
            $edu = Education::find($this->check($request['education_id']));
            $edu->delete();

            return redirect()->route('admin.education')->with('message', 'Delete Education Field Successful!');
        }
    }

    public function jobPosition(Request $request, $action = null)
    {
        if ($action == null) {
            $data = array(
                'jobPosition' => JobPosition::all(),
            );
            return view('admin.jobPosition', $data);
        } else if ($action == 'add') {
            $job = new JobPosition;
            $job->job_position_id = $request['job_position_id'];
            $job->job_position_name = Str::upper($request['job_position_name']);
            $job->save();

            return redirect()->route('admin.jobPosition')->with('message', 'Add Job Position Successful!');
        } else if ($action == 'delete') {
            $job = JobPosition::find($this->check($request['job_position_id']));
            $job->delete();

            return redirect()->route('admin.jobPosition')->with('message', 'Delete Job Position Successful!');
        }
    }

}
