<?php

namespace App\Pattern\State;

class PendingReactivationState implements UserStateInterface
{
    public function suspend(UserContext $context)
    {
        $user = $context->getUser();
        $user->reactivation_requested = false;
        $user->save();
        $context->setState(new BannedState());
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
        // Already requested
    }
}
