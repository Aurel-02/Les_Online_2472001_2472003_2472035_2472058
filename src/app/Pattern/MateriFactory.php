<?php

namespace App\Pattern;

use App\Pattern\Video\VideoMateri;
use App\Pattern\Catatan\CatatanMateri;
use InvalidArgumentException;

class MateriFactory
{
    /**
     * Factory method untuk membuat instance Materi
     */
    public static function create(string $type): MateriInterface
    {
        return match (strtolower($type)) {
            'video'   => new VideoMateri(),
            'catatan' => new CatatanMateri(),
            default   => throw new InvalidArgumentException("Tipe materi tidak valid: {$type}")
        };
    }
}
