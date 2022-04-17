<?php

namespace App\Http\Controllers;


use App\Models\Event;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Validator;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('dashboard');
    }
    public function userEventList(Request $request)
    {
        $userId = Auth::user()->id;

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
        $totalRecords = Event::select('count(*) as allcount')->where('userId',$userId)->count();
        $totalRecordswithFilter = Event::select('count(*) as allcount')->where('userId',$userId)->where('eventTitle', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Event::orderBy($columnName, $columnSortOrder)
            ->where('eventTitle', 'like', '%' . $searchValue . '%')
            ->where('userId',$userId)
            ->with('getGuest')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start + 1;
        foreach ($records as $record) {
            $id = $record->id;
            $img = '<img src="'.asset('storage/media/' . $record->featuredImage).'" width="100px"/>';
            $eventTitle = $record->eventTitle;
            $location = $record->location;
            $date = dateFormatDMY($record->startDate).' to '.dateFormatDMY($record->endDate);
            $noOfGuest = count($record->getGuest);
            $created_at = date("M jS, Y  @ h:i a", strtotime($record->created_at));
            $action = '';
            $action .= '<a href="' . url('edit-event/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge  btn-success ">Edit</button></a>';

            if ($record->status == 1)
                $action .= ' | <a href="' . url('event-status/0/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-info ">Active</button></a>';

            elseif ($record->status == 0)
                $action .= ' | <a href="' . url('event-status/1/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-warning ">Blocked</button></a>';

                $action .= ' | <a href="' . url('inviteUser/' . Crypt::encrypt($id)) . '"><button type="button" class="btn badge btn-primary ">Invite Users</button></a>';

            $data_arr[] = array(
                "id" => $sno++,
                "img" => $img,
                "eventTitle" => $eventTitle,
                "location" => $location,
                "date" => $date,
                "noOfGuest" => $noOfGuest,
                "created_at" => $created_at,
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

    public function create()
    {
        $result['id']                   = '';
        $result['eventTitle']           = '';
        $result['eventDescription']     = '';
        $result['eventDate']            = '';
        $result['featuredImage']        = '';
        $result['location']             = '';
        $result['address']              = '';

        return view('eventForm', $result);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'eventTitle'      => 'required',
            'eventDate'      => 'required',
            'location'      => 'required',
        ]);

        if ($validator->passes()) {
            try {

                $eventDate = $request->post('eventDate');
                list($from, $to) = explode('- ', $eventDate);
                $userId = Auth::user()->id;

                $model = new Event();
                $model->eventTitle          = $request->post('eventTitle');
                $model->eventDescription    = $request->post('eventDescription');
                $model->startDate           = dateFormat($from);
                $model->endDate             = dateFormat($to);
                $model->location            = $request->post('location');
                $model->address             = $request->post('address');
                $model->userId              = $userId;
                $model->status              = 1;

                if ($request->hasfile('featuredImage')) {
                    $featuredImage = $request->file('featuredImage');
                    $featuredImage_name = time() . rand(1, 100) . '.' . $featuredImage->extension();
                    $featuredImage->move(public_path('/storage/media'), $featuredImage_name);
                    $model->featuredImage = $featuredImage_name; 
                }

                $model->save();
                return response()->json(['status' => 200, 'message' => 'Event Added Successfully','redirectUrl' => 'dashboard']);
            } catch (Exception $e) {
                return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
            }
        }

        return response()->json(['status' => 401, 'error' => $validator->errors(), 'message' => 'Please fill all required fields']);

        // return redirect('admin/country')->with('success', 'Added Successfully');
    }

    
    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $arr = Event::where('id',$id)->first();

        $result['id']                   = $id;
        $result['eventTitle']           = $arr->eventTitle;
        $result['eventDescription']     = $arr->eventDescription;
        $startDate                      = $arr->startDate;
        $endDate                        = $arr->endDate;
        $result['featuredImage']        = $arr->featuredImage;
        $result['location']             = $arr->location;
        $result['address']              = $arr->address;

        $result['eventDate']            = dateFormatDMY($startDate).'- '.dateFormatDMY($endDate);
        
        $result['updated_at']   = date("F j, Y, h:i a", strtotime($arr->updated_at));

        return view('eventForm', $result);
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

        $validator = Validator::make($request->all(), [
            'eventTitle'      => 'required',
            'eventDate'      => 'required',
            'location'      => 'required',
        ]);

        if ($validator->passes()) {
            try {

                $eventDate = $request->post('eventDate');
                list($from, $to) = explode('- ', $eventDate);

                $model = new Event();
                $arr['eventTitle']              = $request->post('eventTitle');
                $arr['eventDescription']        = $request->post('eventDescription');
                $arr['startDate']               = dateFormat($from);
                $arr['endDate']                 = dateFormat($to);
                $arr['location']                = $request->post('location');
                $arr['address']                 = $request->post('address');

                if ($request->hasfile('featuredImage')) {
                    $featuredImage = $request->file('featuredImage');
                    $featuredImage_name = time() . rand(1, 100) . '.' . $featuredImage->extension();
                    $featuredImage->move(public_path('/storage/media'), $featuredImage_name);
                    $arr['featuredImage'] = $featuredImage_name; 
                }

                Event::where('id', $id)->update($arr);
                return response()->json(['status' => 200, 'message' => 'Event Added Successfully','redirectUrl' => '/dashboard']);
            } catch (Exception $e) {
                return response()->json(['status' => 500, 'message' => 'Something Went Wrong (' . $e->getMessage() . ')']);
            }
        }

        return response()->json(['status' => 401, 'error' => $validator->errors(), 'message' => 'Please fill all required fields']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multitask(Request $request)
    {
        $id     = explode(',', $request->post('ids'));
        $task   = $request->post('task');

        foreach ($id as $value) {
            if ($task == 'Delete') {
                Event::find($value)->delete();
            } else if ($task == 'Activate') {
                $arr['status'] = 1;
                Event::where('id', $value)->update($arr);
            } else if ($task == 'Block') {
                $arr['status'] = 0;
                Event::where('id', $value)->update($arr);
            }
        }

        if ($task == 'Delete') {
            return redirect('dashboard')->with('success', 'Deleted Successfully');
        } else if ($task == 'Activate') {
            return redirect('dashboard')->with('success', 'Activated Successfully');
        } else if ($task == 'Block') {
            return redirect('dashboard')->with('success', 'Blocked Successfully');
        }
    }

    public function event_status(Request $request, $status, $id)
    {
        $id = Crypt::decrypt($id);
        $model = Event::find($id);
        $model->status = $status;
        $model->save();
        $message = ($status == 0) ? 'Blocked Successfully' : 'Activated Successfully';
        return redirect('dashboard')->with('success', $message);
    }

}
