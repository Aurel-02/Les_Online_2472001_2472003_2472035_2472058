<?php

namespace App\Pattern\Command\Materi;

use App\Pattern\Command\CommandInterface;
use App\Models\Materi;
use Illuminate\Support\Facades\Storage;

class UpdateMateriCommand implements CommandInterface
{
    protected $id;
    protected $userId;
    protected $data;
    protected $file;

    public function __construct($id, $userId, array $data, $file = null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->data = $data;
        $this->file = $file;
    }

    public function execute()
    {
        $materi = Materi::where('id_materi', $this->id)->where('id_guru', $this->userId)->firstOrFail();

        $filePath = $materi->file_materi;
        if ($this->file) {
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $this->file->store('materi', 'public');
        }

        $this->data['file_materi'] = $filePath;

        $materi->update($this->data);

        // Menggunakan Observer Pattern untuk Notifikasi
        \App\Pattern\Observer\ActivityNotifier::getInstance()->notify([
            'user_id'     => $this->userId,
            'type'        => 'materi',
            'description' => 'Memperbarui materi: ' . ($this->data['judul'] ?? $materi->judul),
        ]);

        return $materi;
    }
}
