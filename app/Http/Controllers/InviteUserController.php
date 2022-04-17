<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\InvitedUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Validator;
use Crypt;
class InviteUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        $decid                = Crypt::decrypt($id);
        $events               = Event::where('id',$decid)->first();
        $result['decid']      = $decid;
        $result['id']         = $id;
        $result['eventTitle'] = $events->eventTitle;
        return view('invitedUsers',$result);
    }
    public function ajaxinviteUserList(Request $request)
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

        $eventId = $request->get('eventId');

        // Total records
        $totalRecords = InvitedUsers::select('count(*) as allcount')
        ->where('eventId', $eventId)->count();
        $totalRecordswithFilter = InvitedUsers::select('count(*) as allcount')
        ->where('eventId', $eventId)->where('userEmail', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = InvitedUsers::orderBy($columnName, $columnSortOrder)
            ->where('userEmail', 'like', '%' . $searchValue . '%')
            ->where('eventId', $eventId)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start + 1;
        foreach ($records as $record) {
            $id = $record->id;
            $email = $record->userEmail;
            $created_at = date("M jS, Y  @ h:i a", strtotime($record->created_at));
            
            $data_arr[] = array(
                "id" => $sno++,
                "userEmail" => $email,
                "created_at" => $created_at,
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

    public function create($eventId)
    {
        $eventId                        = Crypt::decrypt($eventId);
        $events                         = Event::where('id',$eventId)->first();
        $result['id']                   = '';
        $result['userEmail']            = '';
        $result['eventId']              = $eventId;
        $result['eventTitle']           = $events->eventTitle;
        return view('userForm', $result);      
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userEmail'      => 'required',
        ]);

        if ($validator->passes()) {
            try {

                $userEmail = $request->post('userEmail');
                $eventId = $request->post('eventId');
                $userEmailData = explode(',', $userEmail);
                $data = array();
                foreach($userEmailData as $key=>$value){
                    $data = ["userEmail"=>$value,"eventId"=>$eventId];
                    InvitedUsers::create($data);
                }

                $redirectUrl = '/inviteUser/'.Crypt::encrypt($eventId);;
                return response()->json(['status' => 200, 'message' => 'Users Added Successfully','redirectUrl' => $redirectUrl]);
            } catch (Exception $e) {
                return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
            }
        }

        return response()->json(['status' => 401, 'error' => $validator->errors(), 'message' => 'Please fill all required fields']);

    }

    
    
    public function multitask(Request $request)
    {
        $id     = explode(',', $request->post('ids'));
        $task   = $request->post('task');

        foreach ($id as $value) {
            if ($task == 'Delete') {
                InvitedUsers::find($value)->delete();
            } 
        }

        if ($task == 'Delete') {
            return response()->json(['status' => 200, 'message' => 'Deleted Successfully']);
        } 
    }

   

}
