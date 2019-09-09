<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class LangController extends Controller
{
//    public function changeLang($lang)
//    {
//        \Session::put('website-language', $lang); //gan gia tri $lang cho website-language
//        return redirect()->back();
//    }

    private $langActive = [
        'vi',
        'en',
    ];
    public function changeLang(Request $request, $lang)
    {
        if (in_array($lang, $this->langActive)) {
            $request->session()->put(['lang' => $lang]);
            return redirect()->back();
        }
    }
}
