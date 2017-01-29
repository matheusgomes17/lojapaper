<?php

namespace Snaketec\Http\Controllers\Backend\Access\User;

use Snaketec\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use Snaketec\Repositories\Backend\Access\User\UserRepository;
use Snaketec\Http\Requests\Backend\Access\User\ManageUserRequest;

/**
 * Class UserTableController.
 */
class UserTableController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageUserRequest $request)
    {
        return Datatables::of($this->users->getForDataTable($request->get('status'), $request->get('trashed')))
            ->editColumn('confirmed', function ($user) {
                return $user->confirmed_label;
            })
            ->addColumn('roles', function ($user) {
                return $user->roles->count() ?
                    implode('<br/>', $user->roles->pluck('name')->toArray()) :
                    trans('labels.general.none');
            })
            ->addColumn('actions', function ($user) {
                return $user->action_buttons;
            })
            ->withTrashed()
            ->make(true);
    }
}
