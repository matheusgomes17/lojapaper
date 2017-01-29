<?php

namespace Snaketec\Http\Controllers\Frontend\User;

use Snaketec\Http\Controllers\Controller;

/**
 * Class AccountController.
 */
class AccountController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.user.account');
    }
}
