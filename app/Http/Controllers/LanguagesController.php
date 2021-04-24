<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguagesController extends Controller
{
    public function set($locale)
    {
        App::setlocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();

        return back();
    }
}
