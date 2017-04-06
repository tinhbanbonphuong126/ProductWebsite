<?php

namespace App\Http\Controllers\Staff;

use App\OtRequest;
use App\RequestUser;
use App\UserConfirmed;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = \Auth::user();
        /*
        $time_request = '';

        $query = RequestUser::query();
        $query->with(['requests' => function ($q1) {
            $q1->with('funeral');
        }]);
        $query->where('user_id', $user->id);
        if ($request->has('time_request') && $request->get('time_request') != '') {
            $time_request = $request->get('time_request');
            $arrayRequest = [];
            $requests = OtRequest::whereDate('start_time', '>=', $time_request)->get();
            if (!is_null($requests)) {
                foreach ($requests as $item) {
                    $arrayRequest[] = $item->id;
                }
            }
            if (!is_null($arrayRequest)) {
                $query->whereIn('request_id', $arrayRequest);
            }
        }
        */

        $query = RequestUser::query()->where('user_id', $user->id)->orderBy('id', 'desc');
        $workTypes = getSelectType();
        $staffrequest = $query->paginate(\Config::get('setting.paginate'));

        //dd($staffrequest);

        if (!is_null($staffrequest)) {
            foreach ($staffrequest as $key => $item) {
                $staffrequest[$key]->requests->user_confirmed =
                    UserConfirmed::where('user_id', $item->user_id)
                        ->where('request_id', $item->request_id)->where('type_id', $item->type_id)->first();
            }
        }

        return view('staff.staffrequest.index', compact('staffrequest', 'user', 'time_request', 'workTypes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \Auth::user();
        $getReply = getReply();
        $getReason = getReason();

        // check id
        $query = RequestUser::query();
        $query->with(['requests' => function ($q1) {
            $q1->with('funeral');
        }]);
        $query->where('id', $id);
        $query->where('user_id', $user->id);
        $requestUser = $query->first();

        $userId = $requestUser->user_id;
        $requestId = $requestUser->request_id;
        $typeId = $requestUser->type_id;

        if (is_null($requestUser)) {
            return \Redirect::route('staff.staffrequest.index');
        }
        $requestUser->requests->user_confirmed = UserConfirmed::where('user_id', $userId)->where('request_id', $requestId)->where('type_id', $typeId)->first();

        // Set the status of otRequest is NEW! (it is a new reply from Staff)
        $otRequest = OtRequest::where('id', $requestId)->first();
        $otRequest->update([
            'is_new_request' => 1
        ]);

        return view('staff.staffrequest.show', compact('requestUser', 'user', 'getReply', 'getReason'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = \Auth::user();
        $requestData = $request->all();

        UserConfirmed::create(clearData($requestData));

        // send mail to admin
        //$this->sendMailConfirm($requestData);

        return view('staff.staffrequest.success', compact('user'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
