<?php

namespace Helpers;

class ConvertHelper{
    public static function encrypt(string $data): string{
        $key = Settings::env('HASH_KEY');
        $method   = Settings::env('HASH_METHOD');
        $options  = 0;
        $iv       = Settings::env('HASH_IV');
        $data = openssl_encrypt(
                        $data,
                        $method,
                        $key,
                        $options,
                        $iv
                    );
        return $data;
    }

    public static function decrypt(string $data): string{
        $key = Settings::env('HASH_KEY');
        $method   = Settings::env('HASH_METHOD');
        $options  = 0;
        $iv       = Settings::env('HASH_IV');
        $data = openssl_decrypt(
                        $data,
                        $method,
                        $key,
                        $options,
                        $iv
                    );
        return $data;
    }
}