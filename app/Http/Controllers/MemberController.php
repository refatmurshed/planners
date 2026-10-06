<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Member;

class MemberController extends Controller
{
public function members_list()
{
    $members = Member::with('user')->latest()->paginate(100);

    return view('admin.members.members_list', compact('members'));
}


    public function add_member()
    {
        return view('admin.members.add_member');
    }

}
