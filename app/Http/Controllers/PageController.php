<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function tables()
    {
        return view('pages.tables');
    }

    public function billing()
    {
        return view('pages.billing');
    }

    public function virtualReality()
    {
        return view('pages.virtual-reality');
    }

    public function rtl()
    {
        return view('pages.rtl');
    }

    public function notifications()
    {
        return view('pages.notifications');
    }

    public function profile()
    {
        return view('pages.profile');
    }

    public function settings()
    {
        return view('pages.settings');
    }

    public function icons()
    {
        return view('pages.icons');
    }

    public function typography()
    {
        return view('pages.typography');
    }

    public function map()
    {
        return view('pages.map');
    }
}
