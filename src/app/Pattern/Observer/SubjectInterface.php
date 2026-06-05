<?php

namespace App\Pattern\Observer;

interface SubjectInterface
{
    public function attach(ObserverInterface $observer): void;
    public function detach(ObserverInterface $observer): void;
    public function notify(array $data): void;
}
