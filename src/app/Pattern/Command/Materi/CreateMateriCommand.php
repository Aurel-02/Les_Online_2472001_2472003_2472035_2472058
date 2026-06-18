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

        $materi = Materi::create($this->data);

        // Menggunakan Observer Pattern untuk Notifikasi
        \App\Pattern\Observer\ActivityNotifier::getInstance()->notify([
            'user_id'     => $this->data['id_guru'],
            'type'        => 'materi',
            'description' => 'Menambahkan materi baru: ' . $this->data['judul'],
        ]);

        return $materi;
    }
}
