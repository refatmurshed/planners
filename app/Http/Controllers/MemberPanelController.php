<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberPanelController extends Controller
{
    public function subscription()
{
    return view('member.subscription');
}

public function registration()
{
    return view('member.my_registration');
}

}