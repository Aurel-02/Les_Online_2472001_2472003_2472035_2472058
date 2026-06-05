<?php

namespace App\Pattern\Observer;

interface ObserverInterface
{
    public function update(array $data): void;
}
