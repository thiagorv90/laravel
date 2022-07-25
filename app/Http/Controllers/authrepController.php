<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Users;


class authrepController extends Controller
{
    public function authindex()
    {
        $events = DB::table('users')->get();

        return view('repsup/autenrep', compact('events'));
    }

    public function authcreate()
    {
        return view('repsup/repsup', compact('event'));
    }
}
