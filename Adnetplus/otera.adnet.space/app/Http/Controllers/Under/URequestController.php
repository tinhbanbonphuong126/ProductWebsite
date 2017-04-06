<?php

namespace App\Http\Controllers\Under;

use App\ClassificationRequest;
use App\Funeral;
use App\OtRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UrescreateRequest;

class URequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectFuneral = $this->getFuneral();
        $undertaker = \Auth::guard('undertaker')->user();
        return view('undertaker.urequest.create', compact('selectFuneral', 'undertaker'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UrescreateRequest $request)
    {
        $requestData = $request->all();
        //dd($requestData);
        $undertaker = \Auth::guard('undertaker')->user();
        return view('undertaker.urequest.show', compact('undertaker', 'requestData'));
    }

    public function addRequest(UrescreateRequest $request)
    {
        $undertaker = \Auth::guard('undertaker')->user();
        try {
            $requestData = $request->all();
            $result = OtRequest::create($requestData);
            $requestData['request_id'] = $result->id;

            // add ClassificationRequest
            for ($i = 1; $i <= 3; $i++) {
                if ($requestData['request_' . $i . '_count_nin']) {
                    ClassificationRequest::create([
                        'request_id' => $result->id,
                        'type_id' => $requestData['request_' . $i . '_type_id'],
                        'count_nin' => $requestData['request_' . $i . '_count_nin'],
                        'time_start' => $requestData['request_' . $i . '_time_start'],
                        'time_end' => $requestData['request_' . $i . '_time_end'],
                    ]);
                }
            }

            // send mail for admin
            $this->sendMailAdmin($requestData, $undertaker);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return view('undertaker.success', compact('undertaker'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

    public function getFuneral()
    {
        $select = [];
        $alls = Funeral::all();
        if (!is_null($alls) && count($alls) > 0) {
            foreach ($alls as $item) {
                $select[$item->id] = $item->funeral_name;
            }
        }
        return $select;
    }

    // Undertake mails to Admin for new OT request
    public function sendMailAdmin($data, $undertaker)
    {
        // Admin
        $mail_from = \Config::get("setting.admin_email");
        $mail_from_name = "管理者";

        // Undertaker
        //$mail_from = $undertaker->emails;
        //$mail_from_name = $undertaker->undertaker_name;
        $mail_to = \Config::get('setting.admin_email');
        $to_undertaker = $undertaker->emails;

        $subject = '新規依頼';

        $header = "From: " . $mail_from_name . " <" . $mail_from . ">\n";
        $header .= "MIME-Version: 1.0\n";

        $message = "";
        $message .= "依頼主名: " . $undertaker->undertaker_name . "様\n";
        $message .= "派遣依頼がありました。\n\n";
        $message .= "依頼内容 \n";
        $message .= "葬儀の種類: " . $this->getNameFuneralRequest($data["funeral_id"]) . "\n";
        $message .= "式名: 故 " . replaceStrKishuizon($data["funeral_name"]) . "\n";
        $message .= "開式時間: " . date("Y/m/d H:i", strtotime($data["start_time"])) . "\n";
        $message .= "喪主名: " . replaceStrKishuizon($data["chief_name"]) . "\n";
        $message .= "宗派: " . replaceStrKishuizon($data["religious"]) . " 宗 " . replaceStrKishuizon($data["faction"]) . " 派 \n";
        $message .= "寺院名: " . replaceStrKishuizon($data["otera_name"]) . "\n";
        $message .= "会場名: " . replaceStrKishuizon($data["venue"]) . " \n";
        $message .= "会場住所: " . replaceStrKishuizon($data["venue_address"]) . " \n";
        $message .= "回葬予想人数: 約" . $data["times_funeral"] . "名 \n\n";
        $message .= "発注業務 \n";

        $message .= "司会・進行: ";
        $request = OtRequest::where("id", $data['request_id'])->first();
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
        $message .= replaceStrKishuizon($data["contact_matter"]);
        $message .= "\n\n";
        $message .= "ログイン画面\n";
        $message .= url("/auth/login");

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");

        // send mail to admin
        mb_send_mail($mail_to, $subject, $message, $header);
        // send mail to undertaker
        mb_send_mail($to_undertaker, $subject, $message, $header);
    }

    public function getNameFuneralRequest($id)
    {
        $funeral = Funeral::where("id", $id)->first();
        return $funeral->funeral_name;
    }
}
