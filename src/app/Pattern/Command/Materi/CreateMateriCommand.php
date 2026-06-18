<?php

namespace App\Pattern\Command\Materi;

use App\Pattern\Command\CommandInterface;
use App\Models\Materi;

class CreateMateriCommand implements CommandInterface
{
    protected $data;
    protected $file;

    public function __construct(array $data, $file = null)
    {
        $this->data = $data;
        $this->file = $file;
    }

    public function execute()
    {
        $filePath = null;

        if ($this->file) {
            $filePath = $this->file->store('materi', 'public');
        }

        $this->data['file_materi'] = $filePath;

        return Materi::create($this->data);
    }
}
