<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $searchKeyword = $request->searchKeyword;
            $filterDate = $request->filterDate;
            
            $result['events'] = Event::where(['status'=>'1'])
                                    ->when(($searchKeyword!=''), function ($query) use ($searchKeyword) {
                                        return $query->where('eventTitle', 'like', '%' . $searchKeyword . '%')
                                        ->orWhere('location', 'like', '%' . $searchKeyword . '%')
                                        ->orWhere('address', 'like', '%' . $searchKeyword . '%');
                                    })
                                    ->when(($filterDate!=''), function ($query) use ($filterDate) {
                                        list($from, $to) = explode('- ', $filterDate);
                                        return $query->where('startDate', '>=' ,dateFormat(trim($from)))
                                        ->where('endDate', '<=' , dateFormat(trim($to)));
                                    })
                                ->with('getUser')
                                ->with('getGuest')
                                ->orderBy('created_at','DESC')
                                ->paginate(4);

            if (!empty($result)) {
                $artilces = view('eventAjax',$result)->render();
                return $artilces;
            } 
            else return FALSE;
        }
        return view('home');
    }

    public function statistics(){

        $result['users'] = User::withCount('getEvent')->get();
        $result['totalEvents'] = Event::count();
        return view('statistics',$result);
    }

    
}
