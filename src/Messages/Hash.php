<?php
/**
 * Contains the Hash class.
 *
 * @copyright   Copyright (c) 2019 Attila Fulop
 * @author      Attila Fulop
 * @license     MIT
 * @since       2019-12-26
 *
 */

namespace Konekt\Euplatesc\Messages;

/**
 * Euplatesc Hashing methods, provided by the vendor, re-bundled
 */
final class Hash
{
    public static function euplatescMac($data, $key)
    {
        $str = null;

        foreach ($data as $d) {
            if ($d === null || strlen($d) == 0) {
                $str .= '-';
            } // null values are replaced with dashes (-)
            else {
                $str .= strlen($d) . $d;
            }
        }

        $key = pack('H*', $key);

        return self::hmacsha1($key, $str);
    }

    private static function hmacsha1($key, $data)
    {
        $blocksize = 64;
        $hashfunc  = 'md5';

        if (strlen($key) > $blocksize) {
            $key = pack('H*', $hashfunc($key));
        }

        $key  = str_pad($key, $blocksize, chr(0x00));
        $ipad = str_repeat(chr(0x36), $blocksize);
        $opad = str_repeat(chr(0x5c), $blocksize);

        $hmac = pack('H*', $hashfunc(($key ^ $opad) . pack('H*', $hashfunc(($key ^ $ipad) . $data))));

        return bin2hex($hmac);
    }
}
