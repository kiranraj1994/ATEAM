<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use Crypt;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }
        return view('login');
    }
    public function auth(Request $request)
    {
        $request->validate([
            'email'      => 'required|email',
            'password'   => 'required',
        ]);

        $email      = $request->post('email');
        $password   = $request->post('password');
        $result     = USER::where(['email' => $email])->first();

        if (!empty($result)) {
            $userdata = array(
                'email'     => $email,
                'password'  => $password
            );
            if (Auth::attempt($userdata)) {
                return redirect('dashboard')->with('success', 'Logged In Successfully');
            } else {
                return redirect('login')->with('error', 'Incorrect Password');
            }
        } else {
            return redirect('login')->with('error', 'Given Email-id is not registered with us');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login')->with('success', 'Signed Out Successfully');
    }

    public function create()
    {
        return view('sign_up');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required',
            'email'                 => 'required|email',
            'dob'                   => 'required',
            'gender'                => 'required|string|in:male,female',
            'password'              => 'min:8|required_with:confirmPassword|same:confirmPassword',
            'confirmPassword'       => 'min:8',

        ]);

        try{
            $model              = new User();

            $model->name        = $request->post('name');
            $model->email       = $request->post('email');
            $model->password    = Hash::make($request->post('password'));
            $model->dob         = dateFormat($request->post('dob'));
            $model->gender      = $request->post('gender');
            
            if($model->save()){
                return redirect('login')->with('success', 'Signed Up Successfully, Login To Continue');
            }
            else{
                return redirect('sign-up')->with('error', 'something went wrong');
            } 
        }catch(Exception $message) {
            return redirect('sign-up')->with('error', $message->getMessage());
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }
    public function userEventList(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Event::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Event::select('count(*) as allcount')->where('eventTitle', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Event::orderBy($columnName, $columnSortOrder)
            ->where('eventTitle', 'like', '%' . $searchValue . '%')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start + 1;
        foreach ($records as $record) {
            $id = $record->id;
            $eventTitle = $record->eventTitle;
            $location = $record->location;
            $date = $record->startDate.' to '.$record->endDate;
            $eventTitle = $record->eventTitle;
            $created_at = date("M jS, Y  @ h:i a", strtotime($record->created_at));
            $updated_at = date("M jS, Y @ h:i a", strtotime($record->updated_at));

            $action = '';
            $action .= '<a href="' . url('admin/edit-event/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge  btn-success ">Edit</button></a>';

            if ($record->status == 1)
                $action .= ' | <a href="' . url('admin/event-status/0/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-info ">Active</button></a>';

            elseif ($record->status == 0)
                $action .= ' | <a href="' . url('admin/event-status/1/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-warning ">Blocked</button></a>';

            $data_arr[] = array(
                "id" => $sno++,
                "title" => $eventTitle,
                "location" => $location,
                "date" => $date,
                "noOfGuest" => '5',
                "created_at" => $created_at,
                "updated_at" => $updated_at,
                "action" => $action,
                "check" => '<input type="checkbox" class="checkboxes recordcheckbox" value="' . $id . '"/>',
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }

}
