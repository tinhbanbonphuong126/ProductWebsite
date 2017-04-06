<?php

use \App\Type;
use \App\User;
use \App\Reason;
use \App\Funeral;
use \App\RequestUser;
use \App\UserConfirmed;
use \App\ClassificationRequest;

function generatePassword()
{
    $string = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -5);
    $string .= strtotime("now");
    return substr($string, 1, 8);
}

function generateID()
{
    return \Config::get('setting.ID') . substr(str_shuffle("0123456789"), -4);
}

function encryptIt($q)
{
    $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
    return ($qEncoded);
}

function decryptIt($q)
{
    $cryptKey = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
    return ($qDecoded);
}

function clearData($data = array())
{
    unset($data['_token']);
    unset($data['_method']);
    unset($data['id']);
    return $data;
}

function clearPaswordAccount($data = array())
{
    unset($data['password']);
    unset($data['account_id']);
    return $data;
}

function getStatus()
{
    return [
        1 => '全て',
        2 => '完了', // status = 1
        3 => '未完了', // status = 0
    ];
}

function getReply()
{
    return [
        1 => '受ける',
        2 => '断る',
    ];
}

function getReason()
{
    $reason = Reason::get();
    $reasonArray = [];
    if (!is_null($reason) && count($reason) > 0) {
        foreach ($reason as $item) {
            $reasonArray[$item->id] = $item->name;
        }
    }
    return $reasonArray;
}

function checkUserRequest($user_id, $request_id, $type_id)
{
    $result = RequestUser::where('user_id', $user_id)->where('request_id', $request_id)->where('type_id', $type_id)->first();
    return $result ? true : false;
}

function checkUserAgree($user_id, $request_id, $type_id)
{
    $result = UserConfirmed::where('user_id', $user_id)->where('request_id', $request_id)->where('type_id', $type_id)->first();
    if ($result) {
        if ($result->type_confirm == 1 && $result->delflag == 0) {
            return 1; // agree
        } else {
            return 2; // not agree
        }
    } else {
        return 0;// not confirmed yet
    }
}

// get array user type
// return array user id with type
function getUserType($typeId)
{
    $userID = [];
    $users = User::where('role', 0)->where('type_id', $typeId)->where('delflag', 0)->get();
    if (!is_null($users) && count($users) > 0) {
        foreach ($users as $key => $item) {
            $userID[$key] = $item->id;
        }
    }
    return $userID;
}

function getSelectType()
{
    $typeSelect = [];
    $types = Type::all();
    if (!is_null($types) && count($types) > 0) {
        foreach ($types as $type) {
            $typeSelect[$type->id] = $type->name;
        }
    }
    return $typeSelect;
}

function removeAmPM($str)
{
    $str = str_replace("午前", "", $str);
    $str = str_replace("午後", "", $str);
    return $str;
}

function getNameByFuneralId($funeral_id)
{
    $funeral = Funeral::where("id", $funeral_id)->first();
    return $funeral->funeral_name;
}

/**
 * count user confirm with request id
 * @param $request_id
 * @param $userArray
 * @return mixed
 */
function countUserConfirm($request_id, $type_id, $userArray)
{
    return UserConfirmed::where('request_id', $request_id)
        ->whereIn('type_id', $type_id == 1 ? [1, 3] : [2, 3])
        ->where('type_confirm', 1)
        ->whereIn('user_id', $userArray)
        ->count();
}

function countUserConfirmed($requestId, $typeId)
{
    return UserConfirmed::where('request_id', $requestId)
        ->where('type_id', $typeId)
        ->where('type_confirm', 1)
        ->count();
}

function countUserNotConfirm($workTypeId, $otRequestId)
{
    $countRequest = ClassificationRequest::where('request_id', $otRequestId)
        ->where('type_id', $workTypeId)
        ->sum('count_nin');
    $countConfirm = UserConfirmed::where('request_id', $otRequestId)
        ->whereIn('type_id', $workTypeId == 1 ? [1, 3] : [2, 3])
        ->where('type_confirm', 1)
        ->count();

    return $countRequest - $countConfirm;
}

// Check if OtRequest is enough confirmed about the number of MC and Assistant positions
function isConfirmedRequest($otRequestId)
{
    for ($i = 1; $i <= 2; $i++) {
        $countRequest = ClassificationRequest::where('request_id', $otRequestId)->where('type_id', $i)->sum('count_nin');
        $countConfirm = countUserConfirmed($otRequestId, $i);
        if ($countConfirm < $countRequest) {
            return false;
        }
    }
    return true;
}

function replaceStrKishuizon($subject)
{
    // 現在の文字コードを取得
//    $_encode = mb_detect_encoding($subject, "UTF-8,SJIS-WIN,SJIS,EUC");
//
//    // SJIS-winに変換
//    if( $_encode != "SJIS-win" )
//    {
//        mb_convert_encoding($subject, "SJIS-win", $_encode);
//    }

    $search = Array('Ⅰ', 'Ⅱ', 'Ⅲ', 'Ⅳ', 'Ⅴ', 'Ⅵ', 'Ⅶ', 'Ⅷ', 'Ⅸ', 'Ⅹ', '①', '②', '③', '④', '⑤', '⑥', '⑦', '⑧', '⑨', '⑩', '№', '㈲', '㈱', '㈹', '㈳');
    $replace = Array('I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', '(1)', '(2)', '(3)', '(4)', '(5)', '(6)', '(7)', '(8)', '(9)', '(10)', 'No.', '（有）', '（株）', '（代）', '（社）');

    $result = str_replace($search, $replace, $subject);

    // UTF-8に変換
    //$result = mb_convert_encoding($ret, 'UTF-8', "SJIS-win");

    return $result;
}
