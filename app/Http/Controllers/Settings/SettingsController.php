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

    public function sac()
    {
        $user = Auth::user();
        header('Location: https://api.whatsapp.com/send?phone='.$user->phone);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function talkWithSales()
    {
        $user = Auth::user();
        return Redirect::to('https://api.whatsapp.com/send?phone='.$user->phone);
    }

}
