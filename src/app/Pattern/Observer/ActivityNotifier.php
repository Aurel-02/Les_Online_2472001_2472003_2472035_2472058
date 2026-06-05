<?php

namespace App\Pattern\Observer;

class ActivityNotifier implements SubjectInterface
{
    /** @var ObserverInterface[] */
    private array $observers = [];
    private static ?ActivityNotifier $instance = null;

    private function __construct() {}

    public static function getInstance(): ActivityNotifier
    {
        if (self::$instance === null) {
            self::$instance = new ActivityNotifier();
        }
        return self::$instance;
    }

    public function attach(ObserverInterface $observer): void
    {
        $hash = spl_object_hash($observer);
        $this->observers[$hash] = $observer;
    }

    public function detach(ObserverInterface $observer): void
    {
        $hash = spl_object_hash($observer);
        if (isset($this->observers[$hash])) {
            unset($this->observers[$hash]);
        }
    }

    public function notify(array $data): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($data);
        }
    }
}
