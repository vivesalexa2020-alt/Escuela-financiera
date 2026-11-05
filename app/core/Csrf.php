<?php
namespace App\Core;

class Csrf {
    public static function generateToken(): string {
        Session::start();
        $token = Session::get('csrf_token');
        if (empty($token)) {
            $token = bin2hex(random_bytes(32));
            Session::set('csrf_token', $token);
        }
        return $token;
    }

    public static function validateToken(?string $token): bool {
        Session::start();
        $stored = Session::get('csrf_token');
        if (empty($stored) || empty($token)) {
            return false;
        }
        return hash_equals($stored, $token);
    }

    public static function getToken(): string {
        return self::generateToken();
    }
}
