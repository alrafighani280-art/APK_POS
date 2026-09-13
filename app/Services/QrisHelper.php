<?php

namespace App\Services;

class QrisHelper
{
    public static function generateDynamicQris(string $staticQris, int $nominal): string
    {
        $qris = substr($staticQris, 0, -8);

        $qris = str_replace('010211', '010212', $qris);

        $nominalStr = (string) $nominal;
        $nominalTag = '54' . str_pad(strlen($nominalStr), 2, '0', STR_PAD_LEFT) . $nominalStr;

        $parts = explode('5802ID', $qris);
        $qrisWithAmount = $parts[0] . $nominalTag . '5802ID' . $parts[1];

        $crc = self::crc16($qrisWithAmount . '6304');

        return $qrisWithAmount . '6304' . $crc;
    }

    private static function crc16(string $data): string
    {
        $crc = 0xFFFF;

        for ($i = 0; $i < strlen($data); $i++) {
            $crc ^= (ord($data[$i]) << 8);
            for ($j = 0; $j < 8; $j++) {
                $crc = ($crc & 0x8000) ? (($crc << 1) ^ 0x1021) : ($crc << 1);
                $crc &= 0xFFFF;
            }
        }

        return strtoupper(str_pad(dechex($crc), 4, '0', STR_PAD_LEFT));
    }
}