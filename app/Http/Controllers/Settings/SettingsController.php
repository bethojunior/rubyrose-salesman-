<?php


namespace App\Http\Controllers\Settings;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends Controller
{

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function social()
    {
        return Redirect::to('https://instabio.cc/rubyrosece');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sac()
    {
        return view('settings.sac');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function talkWithSales()
    {
        $user = Auth::user();
        return Redirect::to('https://instabio.cc/comercialrr');
    }

}
