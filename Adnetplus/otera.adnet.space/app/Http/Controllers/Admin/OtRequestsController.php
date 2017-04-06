<?php

namespace App\Http\Controllers\Admin;

use App\ClassificationRequest;
use App\Funeral;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\OtRequest;
use App\RequestUser;
use App\Undertaker;
use App\User;
use App\UserConfirmed;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;

class OtRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $undertaker_name = '';
        $status = 1;
        $query = OtRequest::query();
        $query->select('request.*', 'undertaker.undertaker_name');
        $query->leftJoin('undertaker', function ($join) {
            $join->on('undertaker.id', '=', 'request.undertaker_id');
        });
        $query->where('request.delflag', 0);
        if (Input::has('undertaker_name') && Input::get('undertaker_name') != '') {
            $undertaker_name = Input::get('undertaker_name');
            $query->where('undertaker.undertaker_name', 'LIKE', '%' . Input::get('undertaker_name') . '%');
        }
        if (Input::has('status') && Input::get('status') != 1) {
            $status = Input::get('status');
            if ($status == 2) {
                $query->where('status', 1);
            } else {
                $query->where('status', 0);
            }
        }
        $query->orderBy('id', 'DESC');
        $getStatus = getStatus();
        $otrequests = $query->paginate(\Config::get('setting.paginate'));

        return view('admin.ot-requests.index', compact('otrequests', 'undertaker_name', 'getStatus', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.ot-requests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        OtRequest::create($requestData);

        Session::flash('flash_message', 'OtRequest added!');

        return redirect('admin/ot-requests');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $otrequest = OtRequest::with('funeral', 'undertaker', 'classification_request')->findOrFail($id);

        $curYear = date('Y');
        $curMonth = date('m');
        $curDay = date('d');

        return view('admin.ot-requests.show', compact('otrequest', 'curYear', 'curMonth', 'curDay'));
    }

    public function showRequest($id)
    {
        $otrequest = OtRequest::with('funeral', 'undertaker', 'classification_request')->findOrFail($id);
        if (!is_null($otrequest)) {
            $otrequest->start_time = date('Y/m/d H:i', strtotime($otrequest->start_time));
        }
        return \Response::json($otrequest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $otrequest = OtRequest::findOrFail($id);

        return view('admin.ot-requests.edit', compact('otrequest'));
    }

    public function staff($id)
    {
        $requests = OtRequest::where('id', $id)->first();

        if (is_null($requests)) {
            return \Redirect::route('admin.ot-requests.index');
        }

        // Set the status of otRequest is checked already (it is a new reply from Staff)
        if ($requests->is_new_request == 1) {
            $requests->update([
                'is_new_request' => 0
            ]);
        }

        $type1_noconfirm = countUserNotConfirm(1, $id);
        $type2_noconfirm = countUserNotConfirm(2, $id);

        $query = UserConfirmed::query();
        $query->with(['user' => function ($q1) {
            $q1->with('type_work');
        }]);
        $query->where('request_id', $id);
        $confirmRequest = $query->paginate(\Config::get('setting.paginate'));

        $workTypes = getSelectType();

        return view(
            'admin.ot-requests.staff',
            compact('confirmRequest', 'workTypes', 'requests', 'type1_noconfirm', 'type2_noconfirm')
        );
    }

    public function answerRequest($id)
    {
        $confirmRequest = UserConfirmed::with('user', 'reason')->where('id', $id)->first();
        return view('admin.ot-requests.answer', compact('confirmRequest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $requestData = $request->all();

        $otrequest = OtRequest::findOrFail($id);
        $otrequest->update($requestData);

        Session::flash('flash_message', 'OtRequest updated!');

        return redirect('admin/ot-requests');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        OtRequest::where('id', $id)->update([
            'delflag' => 1
        ]);
        return redirect('admin/ot-requests');
    }

    public function deleteUserConfirmed($id)
    {
        $userconfirm = UserConfirmed::where('id', $id)->first();
        $delflag = 0;
        if ($userconfirm->delflag == 0) {
            $delflag = 1;
        }
        UserConfirmed::where('id', $id)->update([
            'delflag' => $delflag
        ]);
        echo $delflag;
    }

    public function doneRequest($id, Request $request)
    {
        $status = 0;
        if ($request->get('status') == 0) {
            $status = 1;
        }
        OtRequest::where('id', $id)->update([
            'status' => $status
        ]);
        return redirect('admin/ot-requests');
    }

    public function chooseStafff($id)
    {
        $undertaker = [];
        $countNin1 = $countNin2 = 0;
        $userType1 = $userType2 = [];

        $request = OtRequest::with('classification_request')->where('id', $id)->first();
        if ($request) {
            $undertaker = Undertaker::where('id', $request->undertaker_id)->first();

            foreach($request->classification_request as $item) {
                if ($item->type_id == 1) {
                    $countNin1 = $item->count_nin;
                } elseif ($item->type_id == 2) {
                    $countNin2 = $countNin2 + $item->count_nin;
                }
            }

            if ($countNin1) {
                $userType1 = User::whereIn('type_id', [1, 3])->where('role', '<>', 1)->where('delflag', 0)->get();
            }
            if ($countNin2) {
                $userType2 = User::whereIn('type_id', [2, 3])->where('role', '<>', 1)->where('delflag', 0)->get();
            }
        }

        return view('admin.ot-requests.choose', compact('undertaker', 'request', 'countNin1', 'countNin2', 'userType1', 'userType2'));
    }

    public function chooseProcess(Request $request)
    {
        $otRequestId = $request->get('id_request');
        $listUserTypeId = explode(",", $request->get('array_user_type_id'));

        // Insert request user (user_id => type_id)
        foreach ($listUserTypeId as $item) {
            list($userId, $type_id) = explode("=", $item);
            RequestUser::create([
                'user_id' => $userId,
                'request_id' => $otRequestId,
                'type_id' => $type_id
            ]);

            // send mail to user
            $this->sendMailRequest($userId, $otRequestId, $type_id);
        }

        return redirect('admin/ot-requests');
    }

    public function staffSendMail($id)
    {
        $requests = OtRequest::with('undertaker')->where('id', $id)->first();

        $query = UserConfirmed::query();
        $query->with(['user' => function ($q1) {
            $q1->with('type_work');
        }]);
        $query->where('request_id', $id);
        $query->where('type_confirm', 1);
        $query->where('delflag', 0);
        $confirmRequest = $query->get();

        if (!is_null($confirmRequest)) {
            foreach ($confirmRequest as $item) {
                $this->sendmailChoose($item->user->emails, $item->user->name, $requests);
            }
            $this->sendmailChoose($requests->undertaker->emails, $requests->undertaker->undertaker_name, $requests);
        }

        // update the complete status for the request
        OtRequest::where('id', $id)->update([
            'completed_request' => 1
        ]);

        return redirect('admin/ot-requests/' . $id . '/');
    }

    public function getStatus()
    {
        return [
            1 => '全て',
            2 => '完了',
            3 => '未完了',
        ];
    }

    // Undertaker (company) mails to Admin to inform a new OtRequest
    public function sendMailRequest($user_id, $request_id, $type_id)
    {
        $user = User::where("id", $user_id)->first();
        $request = OtRequest::where("id", $request_id)->first();

        $mail_from = \Config::get("setting.admin_email");
        $mail_to = $user->emails;
        $mail_from_name = "管理者";

        $subject = "新規依頼";

        $header = "From: " . $mail_from_name . " <" . $mail_from . ">\n";
        $header .= "MIME-Version: 1.0\n";

        $message = "";
        $message .= $user->name . "様 \n";
        $message .= "派遣依頼がありました。\n\n";
        $message .= "依頼内容 \n";
        $message .= "葬儀の種類: " . $this->getNameFuneralRequest($request->funeral_id) . "\n";
        $message .= "式名: 故 " . replaceStrKishuizon($request->funeral_name) . "\n";
        $message .= "開式時間: " . date("Y/m/d H:i", strtotime($request->start_time)) . "\n";
        $message .= "喪主名: " . replaceStrKishuizon($request->chief_name) . "\n";
        $message .= "宗派: " . replaceStrKishuizon($request->religious) . " 宗 " . replaceStrKishuizon($request->faction) . " 派 \n";
        $message .= "寺院名: " . replaceStrKishuizon($request->otera_name) . "\n";
        $message .= "会場名: " . replaceStrKishuizon($request->venue) . " \n";
        $message .= "会場住所: " . replaceStrKishuizon($request->venue_address) . " \n";
        $message .= "回葬予想人数: 約" . $request->times_funeral . "名 \n\n";
        $message .= "発注業務 \n";

        $message .= "司会・進行: ";
        foreach ($request->classification_request as $type1) {
            if ($type1->type_id == 1) {
                $message .= $type1->count_nin . " 名" . removeAmPM($type1->time_start) . "時～" . removeAmPM($type1->time_end) . "時 \n";
            }
        }
        $message .= "アシスタント: ";
        foreach ($request->classification_request as $type2) {
            if ($type2->type_id == 2) {
                $message .= $type2->count_nin . " 名" . removeAmPM($type2->time_start) . "時～" . removeAmPM($type2->time_end) . "時\n";
            }
        }

        $message .= "連絡事項: \n";
        $message .= replaceStrKishuizon($request->contact_matter);
        $message .= "\n\n\n";
        $message .= "上記の内容確認後、返信をお願いいたします。\n\n";
        $message .= "派遣社員ログイン画面 \n";
        $message .= url("/staff/login");

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        mb_send_mail($mail_to, $subject, $message, $header);
    }

    // Admin mails to Staff to choose some Staffs
    public function sendmailChoose($mail_to, $name_user, $request)
    {
        // send from
        $from_name = "管理者";
        $from_email = \Config::get("setting.admin_email");

        // mail headers
        $headers = "Mime-Version: 1.0\n";
        $headers .= "From: " . $from_name . " <" . $from_email . ">\n";

        // mail subject
        $subject = "新規依頼";

        // mail body
        $message = "";
        $message .= $name_user . "様\n";
        $message .= "派遣依頼を承りました。\n";
        $message .= "依頼内容 \n";
        $message .= "葬儀の種類: " . $this->getNameFuneralRequest($request->funeral_id) . "\n";
        $message .= "式名: 故 " . replaceStrKishuizon($request->funeral_name) . "\n";
        $message .= "開式時間: " . date("Y/m/d H:i", strtotime($request->start_time)) . "\n";
        $message .= "喪主名: " . replaceStrKishuizon($request->chief_name) . "\n";
        $message .= "宗派: " . replaceStrKishuizon($request->religious) . " 宗 " . replaceStrKishuizon($request->faction) . " 派 \n";
        $message .= "寺院名: " . replaceStrKishuizon($request->otera_name) . "\n";
        $message .= "会場名: " . replaceStrKishuizon($request->venue) . " \n";
        $message .= "会場住所: " . replaceStrKishuizon($request->venue_address) . " \n";
        $message .= "回葬予想人数: 約" . $request->times_funeral . "名 \n";
        $message .= "発注業務 \n";

        $message .= "司会・進行: ";
        foreach ($request->classification_request as $type1) {
            if ($type1->type_id == 1) {
                $message .= $type1->count_nin . " 名" . removeAmPM($type1->time_start) . "時～" . removeAmPM($type1->time_end) . "時 \n";
            }
        }
        $message .= "アシスタント: ";
        foreach ($request->classification_request as $type2) {
            if ($type2->type_id == 2) {
                $message .= $type2->count_nin . " 名" . removeAmPM($type2->time_start) . "時～" . removeAmPM($type2->time_end) . "時\n";
            }
        }

        $message .= "連絡事項: \n";
        $message .= replaceStrKishuizon($request->contact_matter);
        $message .= "\n\n";
        $message .= "上記の内容にて、当日はよろしくお願いいたします。";

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        return mb_send_mail($mail_to, $subject, $message, $headers);
    }

    public function getNameFuneralRequest($id)
    {
        $funeral = Funeral::where("id", $id)->first();
        return $funeral->funeral_name;
    }
}
