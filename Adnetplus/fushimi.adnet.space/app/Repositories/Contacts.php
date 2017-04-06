<?php
/**
 * Created by PhpStorm.
 * User: HUNGLV
 * Date: 3/23/2017
 * Time: 10:35 AM
 */

namespace App\Repositories;


class Contacts
{
    public function sendMail($data, $from){
        mb_language("Japanese");
        mb_internal_encoding ("utf-8");

        $to = $data['email'];
        $to1 = $from;

        $subject = "エントリーありがとうございます - 株式会社 伏見製薬所";
        $subject1 = "【エントリーフォームからメールが届きました】";

        $mail_body = "この度はエントリーありがとうございます。\n";
        $mail_body .= "内容確認後に担当者よりご返信いたしますので、少々お待ち下さい。\n\n\n";

        $mail_body .= "-------------------ご送信内容の確認------------------------------\n";
        $mail_body .= "氏名（漢字）: ". $data['kanji_name'] ."\n";
        $mail_body .= "氏名（ふりがな）: ". $data['furigana_name'] ."\n";
        $mail_body .= "生年月日 : ". $data['year'] ."/".$data['month']."/".$data['day']."\n";
        $mail_body .= "住所 : ". $data['post_code'].$data['prefectures'].$data['house']."\n";
        $mail_body .= "電話番号 : ". $data['phone'] ."\n";
        $mail_body .= "E-mail : ". $data['email'] ."\n";
        $mail_body .= "学校名・学部・専攻 : ".$data['gakou_name']." 大学 ".$data['gakubu']." 学部 ".$data['senmon']." 学科 \n";
        $mail_body .= "ゼミ・研究テーマ : \n". $data['kenkyu_temu'] ."\n\n";
        $mail_body .= "学生時代に力を入れて取り組んだこと : \n". $data['gakusei_jidai'] ."\n\n";
        $mail_body .= "自分の長所・短所 : \n". $data['jibun_chouso'] ."\n\n";
        $mail_body .= "資格・自己PR : \n". $data['shikaku_jiko'] ."\n\n";
        $mail_body .= "希望する職種 : ". $data['shokushu'] ."\n";
        $mail_body .= "希望の理由 : \n". $data['kibou_riyu'] ."\n";
        $mail_body .= "-----------------------------------------------------------------\n\n\n";

        $mail_body .= "このメールに心当たりの無い場合は、お手数ですが\n";
        $mail_body .= "下記連絡先までお問い合わせください。\n\n";

        $mail_body .= "この度はお問い合わせ重ねてお礼申し上げます。\n";
        $mail_body .= "-----------------------------------------------------------------\n";
        $mail_body .= "株式会社 伏見製薬所 \n";
        $mail_body .= "〒763-8605\n";
        $mail_body .= "香川県丸亀市中津町1676 \n";
        $mail_body .= "TEL / 0877-22-6231　FAX / 0877-56-1379 \n";
        $mail_body .= "http://www.fushimi.co.jp/\n";
        $mail_body .= "-----------------------------------------------------------------\n";

        //Formアドレスの設定(差出人)
        $headers = "From: ".$from;

        mb_send_mail($to, $subject, $mail_body , $headers);
        return mb_send_mail($to1, $subject1, $mail_body , $headers);
    }

    public function sendContact($data, $from){
        mb_language("Japanese");
        mb_internal_encoding ("utf-8");

        $to = $data['email'];
        $to1 = $from;

        $subject = "お問い合わせありがとうございます - 株式会社 伏見製薬所";
        $subject1 = "【お問合せフォームからメールが届きました】";

        // body mail jp
        $mail_body = "この度はお問い合わせありがとうございます。\n";
        $mail_body .= "早急に担当者よりご返信いたしますので、少々お待ち下さい。\n";
        $mail_body .= "お急ぎの場合は、下記連絡先までお電話にてご連絡くださいますようお願いいたします。\n\n";

        $mail_body .= "--------------------ご送信内容の確認--------------------------------\n";
        $mail_body .= "企業様名: ". $data['company'] ."\n";
        $mail_body .= "部署名: ". $data['department'] ."\n";
        $mail_body .= "ご担当者名: ". $data['name'] ."\n";
        $mail_body .= "郵便番号: ". $data['zip11'] ."\n";
        $mail_body .= "住所: ". $data['address'] ."\n";
        $mail_body .= "電話番号: ". $data['phone'] ."\n";
        $mail_body .= "メールアドレス: ". $data['email'] ."\n";
        $mail_body .= "ご用件: ". $data['message-type'] ."\n";
        $mail_body .= "お問合わせ内容: ". $data['content'] ."\n";
        $mail_body .= "-----------------------------------------------------------------\n\n";
        $mail_body .= "このメールに心当たりの無い場合は、お手数ですが\n";
        $mail_body .= "下記連絡先までお問い合わせください。\n";

        $mail_body .= "この度はお問い合わせ重ねてお礼申し上げます。\n";
        $mail_body .= "-----------------------------------------------------------------\n";
        $mail_body .= "株式会社 伏見製薬所 \n";
        $mail_body .= "〒763-8605\n";
        $mail_body .= "香川県丸亀市中津町1676 \n";
        $mail_body .= "TEL / 0877-22-6231　FAX / 0877-56-1379 \n";
        $mail_body .= "http://www.fushimi.co.jp/\n";
        $mail_body .= "-----------------------------------------------------------------\n";

        // body mail en

        $en_body = "We appreciate your inquiry.Please wait for a while until we reply.\n\n";

        $en_body .= "----------------Confirmation--------------------------------------\n";
        $en_body .= "Company Name: ". $data['company'] ."\n";
        $en_body .= "Name: ". $data['department'] ."\n";
        $en_body .= "Zip code: ". $data['name'] ."\n";
        $en_body .= "Zip code: ". $data['zip11'] ."\n";
        $en_body .= "address: ". $data['address'] ."\n";
        $en_body .= "Phone number: ". $data['phone'] ."\n";
        $en_body .= "email: ". $data['email'] ."\n";
        $en_body .= "Your message: ". $data['content'] ."\n";
        $en_body .= "-----------------------------------------------------------------\n\n";

        $en_body .= "The following information was sent just now.\n";
        $en_body .= "-----------------------------------------------------------------\n";
        $en_body .= "Please call the following telephone number if you are in a hurry.\n";
        $en_body .= "If you have no idea about this E-mail, we are sorry to trouble you,\n";
        $en_body .= "but please let us know.\n";
        $en_body .= "Thank you.\n";
        $en_body .= "FUSHIMI Pharmaceutical Co., Ltd.\n";
        $en_body .= "TEL: +81-877-22-6231\n";
        $en_body .= "-----------------------------------------------------------------\n";


        $headers = "From: ".$from;

        if ($data['type'] == "en"){
            mb_send_mail($to, $subject, $en_body , $headers);
            return mb_send_mail($to1, $subject1, $en_body , $headers);
        }
        if ($data['type'] == "jp"){
            mb_send_mail($to, $subject, $mail_body , $headers);
            return mb_send_mail($to1, $subject1, $mail_body , $headers);
        }
    }

    public function sendContactMedical($data, $from){
        mb_language("Japanese");
        mb_internal_encoding ("utf-8");


        $to = $data['email'];
        $to1 = $from;

        $subject = "スワローケア ピュアのご注文を承りました - 株式会社 伏見製薬所";
        $subject1 = "【スワローケア ピュアのご注文を承りました】";

        $mail_body = "いつもお世話になっております。\n";
        $mail_body .= "株式会社 伏見製薬所です。\n";
        $mail_body .= "この度はスワローケア ピュアのご注文を頂き、誠にありがとうございました。\n\n";
        $mail_body .= "下記の内容にてご注文を承りました。\n";
        $mail_body .= "ご確認頂き、ご注文内容に間違い等がございましたら、\n";
        $mail_body .= "お手数ですが、下記連絡先までお知らせくださいますよう\n";
        $mail_body .= "お願い申し上げます。\n\n";

        $mail_body .= "--------------------ご送信内容の確認----------------------------\n";
		$mail_body .= "スワローケアピュアの購入\n\n";
        $mail_body .= "数量: ". $data['number'] ."\n";
        $mail_body .= "お名前（漢字）: ". $data['kanji-name'] ."\n";
        $mail_body .= "ふりがな: ". $data['furigana_name'] ."\n";
        $mail_body .= "郵便番号: ". $data['zip11'] ."\n";
        $mail_body .= "住所: ". $data['addr01'] ."\n";
        $mail_body .= "電話番号: ". $data['phone'] ."\n";
        $mail_body .= "メールアドレス: ". $data['email'] ."\n";
        $mail_body .= "ご希望配達日＊: ". $data['month'] ."月 ". $data['day']."日\n";
        $mail_body .= "時間帯: ". $data['time-zone'] ."\n\n\n";
        $mail_body .= "送付先が異なる場合\n\n";
        $mail_body .= "お名前（漢字）: ". $data['kanji1'] ."\n";
        $mail_body .= "ふりがな: ". $data['furigana1'] ."\n";
        $mail_body .= "郵便番号: ". $data['zip21'] ."\n";
        $mail_body .= "住所: ". $data['addr02'] ."\n";
        $mail_body .= "電話番号: ". $data['phone1'] ."\n";
        $mail_body .= "-----------------------------------------------------------------\n\n";

        $mail_body .= "後日、出荷予定日及び商品代金合計額のご連絡をいたしますので、\n";
        $mail_body .= "しばらくお待ちください。\n";
        $mail_body .= "3営業日以内に返信が無い場合には、メールが届いていないことが\n";
        $mail_body .= "考えられますので、お手数ですがもう一度送信してください。\n\n";

        $mail_body .= "この度はお問い合わせ重ねてお礼申し上げます。\n";
        $mail_body .= "-----------------------------------------------------------------\n";
        $mail_body .= "伏見製薬株式会社\n";
        $mail_body .= "〒763-0061\n";
        $mail_body .= "香川県丸亀市昭和町103-1 \n";
        $mail_body .= "TEL 0877-22-7284　FAX 0877-22-6284\n";
        $mail_body .= "URL: http://www.fushimi.co.jp/\n";
        $mail_body .= "-----------------------------------------------------------------\n";

        $headers = "From: ".$from;

        mb_send_mail($to, $subject, $mail_body , $headers);
        return mb_send_mail($to1, $subject1, $mail_body , $headers);
    }
}