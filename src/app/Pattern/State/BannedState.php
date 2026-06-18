<?php

namespace App\Pattern\State;

class BannedState implements UserStateInterface
{
    public function suspend(UserContext $context)
    {
        // Already suspended
    }

    public function activate(UserContext $context)
    {
        $user = $context->getUser();
        $user->restore();
        $user->reactivation_requested = false;
        $user->save();
        $context->setState(new ActiveState());
    }

    public function requestReactivation(UserContext $context)
    {
        $user = $context->getUser();
        $user->reactivation_requested = true;
        $user->save();
        $context->setState(new PendingReactivationState());
    }
}
