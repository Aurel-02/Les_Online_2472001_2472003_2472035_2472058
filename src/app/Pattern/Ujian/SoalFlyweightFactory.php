<?php

namespace App\Pattern\Ujian;

class SoalFlyweightFactory
{
    /**
     * @var array<string, SoalFlyweight>
     */
    private static array $flyweights = [];

    /**
     * Mengambil instance Flyweight, membuatnya jika belum ada.
     */
    public static function getFlyweight(string $tag, string $text, array $options, string $correct, string $explanation): SoalFlyweight
    {
        // Membuat hash sebagai key berdasarkan kombinasi text dan options agar unik
        $key = md5($text . serialize($options));

        if (!isset(self::$flyweights[$key])) {
            self::$flyweights[$key] = new SoalFlyweight($tag, $text, $options, $correct, $explanation);
        }

        return self::$flyweights[$key];
    }

    /**
     * Mengembalikan jumlah Flyweight yang sudah di-cache di memori.
     */
    public static function getCount(): int
    {
        return count(self::$flyweights);
    }
}
