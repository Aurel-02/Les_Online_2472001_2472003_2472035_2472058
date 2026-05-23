<?php

namespace App\Services\Checkout;

abstract class CheckoutHandler
{
    protected ?CheckoutHandler $nextHandler = null;

    public function setNext(CheckoutHandler $handler): CheckoutHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(CheckoutContext $context): void
    {
        if (!$context->isSuccess) {
            return;
        }

        $this->process($context);

        if ($context->isSuccess && $this->nextHandler !== null) {
            $this->nextHandler->handle($context);
        }
    }

    abstract protected function process(CheckoutContext $context): void;
}
