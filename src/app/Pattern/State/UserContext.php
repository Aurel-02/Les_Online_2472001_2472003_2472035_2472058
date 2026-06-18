<?php

namespace App\Pattern\State;

use App\Models\User;

class UserContext
{
    private $state;
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->determineState();
    }

    private function determineState()
    {
        if ($this->user->trashed()) {
            if ($this->user->reactivation_requested) {
                $this->state = new PendingReactivationState();
            } else {
                $this->state = new BannedState();
            }
        } else {
            $this->state = new ActiveState();
        }
    }

    public function setState(UserStateInterface $state)
    {
        $this->state = $state;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function suspend()
    {
        $this->state->suspend($this);
    }

    public function activate()
    {
        $this->state->activate($this);
    }

    public function requestReactivation()
    {
        $this->state->requestReactivation($this);
    }
}
