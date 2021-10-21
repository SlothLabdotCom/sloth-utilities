<?php

namespace Slothlabdotcom\SlothUtilities\Http\Controllers;

class GitController extends Controller
{
    public function index($password)
    {
        if($password == '123456')
        {
            return view('SlothUtilities::git.index');
        }
        return abort('404');
    }
}
