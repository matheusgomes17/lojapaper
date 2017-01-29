<?php

namespace Snaketec\Http\Controllers\Frontend\Auth;

use Snaketec\Models\Access\User\User;
use Snaketec\Http\Controllers\Controller;
use Snaketec\Repositories\Frontend\Access\User\UserRepository;
use Snaketec\Notifications\Frontend\Auth\UserNeedsConfirmation;

/**
 * Class ConfirmAccountController.
 */
class ConfirmAccountController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ConfirmAccountController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param $token
     *
     * @return mixed
     */
    public function confirm($token)
    {
        $this->user->confirmAccount($token);

        return redirect()->route('frontend.auth.login')->withFlashSuccess(trans('exceptions.frontend.auth.confirmation.success'));
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function sendConfirmationEmail(User $user)
    {
        $user->notify(new UserNeedsConfirmation($user->confirmation_code));

        return redirect()->route('frontend.auth.login')->withFlashSuccess(trans('exceptions.frontend.auth.confirmation.resent'));
    }
}
