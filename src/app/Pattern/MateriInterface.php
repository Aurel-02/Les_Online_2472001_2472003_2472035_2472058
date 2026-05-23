<?php

namespace App\Pattern;

interface MateriInterface
{
    /**
     * Mendapatkan nama view untuk materi terkait
     */
    public function getView(): string;

    /**
     * Mendapatkan data yang akan dilempar ke view
     */
    public function getData(): array;
}
