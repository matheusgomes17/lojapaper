<?php

namespace Snaketec\Http\Controllers\Frontend\User;

use Snaketec\Http\Controllers\Controller;
use Snaketec\Http\Requests\Frontend\User\UpdateProfileRequest;
use Snaketec\Repositories\Frontend\Access\User\UserRepository;

/**
 * Class ProfileController.
 */
class ProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ProfileController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return mixed
     */
    public function update(UpdateProfileRequest $request)
    {
        $this->user->updateProfile(access()->id(), $request->all());

        return redirect()->route('frontend.user.account')->withFlashSuccess(trans('strings.frontend.user.profile_updated'));
    }
}
