<?php

namespace App\Controllers\Admin;

use App\Repositories\Contacts;
use App\Repositories\Administrators;

class ContactController extends Controller
{
    private $contact;

    public function __construct()
    {
        parent::__construct();
        if (!$this->request->isAjax()) {
            $this->checkUserLoggedIn();
        }
        $this->contact = new Contacts();
    }

    public function recuirtContact()
    {
        $administrator = new Administrators();
        $obj = $administrator->find(1);
        $result = $this->contact->sendMail($this->request->get('data'), $obj->email);
        if ($result) {
            echo "ok";
        } else {
            echo "Error";
        }
    }

    public function sendContact(){
        $administrator = new Administrators();
        $obj = $administrator->find(1);
        $result = $this->contact->sendContact($this->request->all(), $obj->email);
        if ($result){
            echo "ok";
        }else{
            echo "Error";
        }
    }

    public function sendContactMedical(){
        $administrator = new Administrators();
        $obj = $administrator->find(1);
        $result = $this->contact->sendContactMedical($this->request->all(), $obj->email);
        if ($result){
            echo "ok";
        }else{
            echo "Error";
        }
    }

}