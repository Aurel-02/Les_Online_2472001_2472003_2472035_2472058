<?php

namespace App\Pattern\State;

interface UserStateInterface
{
    public function suspend(UserContext $context);
    public function activate(UserContext $context);
    public function requestReactivation(UserContext $context);
}
