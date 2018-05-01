<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Carbon\Carbon;

// BY: https://stevenwestmoreland.com/2017/03/recording-last-login-information-using-laravel-events.html
class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // we store the time of login in a session id, and when user log out, we will set the user's last login time to this, because when the user login again next time, we want to display the last time of login, not the current time...
        session(['user_login_time' => Carbon::now()]);
    }
}
