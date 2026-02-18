<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class SystemBoot
{
    protected static $pk = <<<Eod
-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAw00dWJgB2YzKYUDiGg+f
fUNzC6E4cvFmYL4GxbHvkVIn3eh9OYLR8wuRIQ6OergcgZ7fehC+ksBPrPWns1kq
ZbL48x3K6xGTCLny/w+u7jCKAUYOleWCTqsCLWh8fTDsMZ0kPiR8K3KleD2ibXX5
utQMMpnm7Rk43QD3EvddOQK7oFDBCjzLR896UjTA37CqROpoXLZzsm7R1GgnRQFH
Wykq0QnxTysv3Rc2rvEdMJd3JVkjFf+8DybCBDT0SceOyqFeMtOrlP9Tdd4GlO0X
q2pMh2EqT2e9wwjsJHwM5QPGwRnU1CD7/EXVCgyeigHpIF2o32G0HQSfaKGsdpMT
1wIDAQAB
-----END PUBLIC KEY-----
Eod;

    public function sig(): string
    {
        $d = app_path() . '|' . request()->getHost();
        return substr(hash('sha256', $d), 0, 16);
    }

    public function v(): bool
    {
        return Cache::remember(base64_decode('c3lzX2Jvb3RfdmFs'), 3600, function () {
            $k = config('app.license_key');
            if (!$k && Storage::exists(base64_decode('bGljZW5zZS5rZXk='))) {
                $k = Storage::get(base64_decode('bGljZW5zZS5rZXk='));
            }
            if (!$k)
                return false;
            return $this->p($k);
        });
    }

    public function p(?string $k): bool
    {
        if (!$k)
            return false;
        try {
            $k = trim($k);
            $e = explode('.', $k);
            if (count($e) !== 2)
                return false;
            $j = base64_decode($e[0]);
            $s = base64_decode($e[1]);
            if (!$j || !$s)
                return false;
            if (openssl_verify($j, $s, self::$pk, OPENSSL_ALGO_SHA256) !== 1)
                return false;
            $d = json_decode($j, true);
            if (!$d)
                return false;
            if (!isset($d[base64_decode('c3lzdGVtX3NpZ25hdHVyZQ==')]))
                return false;
            if ($d[base64_decode('c3lzdGVtX3NpZ25hdHVyZQ==')] !== $this->sig())
                return false;
            if (isset($d[base64_decode('ZXhwaXJlc19hdA==')]) && $d[base64_decode('ZXhwaXJlc19hdA==')] !== null) {
                if (now()->timestamp > $d[base64_decode('ZXhwaXJlc19hdA==')])
                    return false;
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function store(string $k): bool
    {
        if ($this->p($k)) {
            Storage::put(base64_decode('bGljZW5zZS5rZXk='), $k);
            Cache::forget(base64_decode('c3lzX2Jvb3RfdmFs'));
            return true;
        }
        return false;
    }

    public function meta(): ?array
    {
        $k = config('app.license_key');
        if (!$k && Storage::exists(base64_decode('bGljZW5zZS5rZXk='))) {
            $k = Storage::get(base64_decode('bGljZW5zZS5rZXk='));
        }
        if (!$k)
            return null;
        try {
            $e = explode('.', trim($k));
            if (count($e) !== 2)
                return null;
            return json_decode(base64_decode($e[0]), true);
        } catch (\Exception $e) {
            return null;
        }
    }
}
