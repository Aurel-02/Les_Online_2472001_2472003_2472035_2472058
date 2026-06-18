<?php

namespace App\Pattern\State;

class ActiveState implements UserStateInterface
{
    public function suspend(UserContext $context)
    {
        $user = $context->getUser();
        $user->delete();
        $context->setState(new BannedState());
    }

    public function activate(UserContext $context)
    {
        // Already active
    }

    public function requestReactivation(UserContext $context)
    {
        // Already active
    }
}
