<?php

namespace App\Pattern\Observer;

use App\Models\Activity;

class DatabaseActivityLogger implements ObserverInterface
{
    public function update(array $data): void
    {
        // Menyimpan data ke dalam tabel Activity
        Activity::create($data);
    }
}
