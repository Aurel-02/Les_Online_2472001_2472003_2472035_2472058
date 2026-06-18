<?php

namespace App\Pattern\Command\Materi;

use App\Pattern\Command\CommandInterface;
use App\Models\Materi;
use Illuminate\Support\Facades\Storage;

class DeleteMateriCommand implements CommandInterface
{
    protected $id;
    protected $userId;

    public function __construct($id, $userId)
    {
        $this->id = $id;
        $this->userId = $userId;
    }

    public function execute()
    {
        $materi = Materi::where('id_materi', $this->id)->where('id_guru', $this->userId)->firstOrFail();
        
        if ($materi->file_materi) {
            Storage::disk('public')->delete($materi->file_materi);
        }
        $judul = $materi->judul;
        $deleted = $materi->delete();

        // Menggunakan Observer Pattern untuk Notifikasi
        \App\Pattern\Observer\ActivityNotifier::getInstance()->notify([
            'user_id'     => $this->userId,
            'type'        => 'materi',
            'description' => 'Menghapus materi: ' . $judul,
        ]);

        return $deleted;
    }
}
