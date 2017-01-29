<?php

namespace Snaketec\Models\Access\User\Traits;

use Snaketec\Notifications\Frontend\Auth\UserNeedsPasswordReset;

/**
 * Trait UserSendPasswordReset.
 */
trait UserSendPasswordReset
{
    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserNeedsPasswordReset($token));
    }
}
