<?php

namespace Snaketec\Http\Controllers\Backend\Access\User;

use Snaketec\Models\Access\User\User;
use Snaketec\Http\Controllers\Controller;
use Snaketec\Notifications\Frontend\Auth\UserNeedsConfirmation;
use Snaketec\Http\Requests\Backend\Access\User\ManageUserRequest;

/**
 * Class UserConfirmationController.
 */
class UserConfirmationController extends Controller
{
    /**
     * @param User              $user
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function sendConfirmationEmail(User $user, ManageUserRequest $request)
    {
        $user->notify(new UserNeedsConfirmation($user->confirmation_code));

        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.confirmation_email'));
    }
}
