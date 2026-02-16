<?php

namespace App\Services\License;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class LicenseService
{
    /**
     * The public key used to verify licenses.
     */
    protected static $publicKey = <<<Eod
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

    /**
     * Get the unique signature for this installation.
     * Combines Domain + Installation Path to lock it to this specific folder on this specific server.
     */
    public function getSystemSignature(): string
    {
        // We use the application path and the host (domain)
        // If the user moves the folder or changes the domain, this hash changes.
        // We hash it to make it look cleaner.
        $data = app_path() . '|' . request()->getHost();
        return substr(hash('sha256', $data), 0, 16);
    }

    /**
     * Check if the application has a valid license.
     */
    public function checkLicense(): bool
    {
        // Use Cache to avoid heavy crypto on every request
        // We cache the result for 60 minutes
        return Cache::remember('app_license_status', 3600, function () {
            // First check config/env
            $licenseKey = config('app.license_key');

            // If not in config, check our storage file
            if (!$licenseKey && Storage::exists('license.key')) {
                $licenseKey = Storage::get('license.key');
            }

            if (!$licenseKey) {
                return false;
            }

            return $this->verifyLicense($licenseKey);
        });
    }

    /**
     * Verify a license string.
     */
    public function verifyLicense(?string $licenseKey): bool
    {
        if (!$licenseKey)
            return false;

        try {
            $licenseKey = trim($licenseKey);
            // content is expected to be: base64(json_payload) . '.' . base64(signature)
            $parts = explode('.', $licenseKey);

            if (count($parts) !== 2) {
                return false;
            }

            $payloadJson = base64_decode($parts[0]);
            $signature = base64_decode($parts[1]);

            if (!$payloadJson || !$signature) {
                return false;
            }

            // 1. Verify Signature with Public Key
            $ok = openssl_verify($payloadJson, $signature, self::$publicKey, OPENSSL_ALGO_SHA256);

            if ($ok !== 1) {
                // Signature Invalid
                return false;
            }

            // 2. Verify Payload Content (Machine/Domain Lock)
            $data = json_decode($payloadJson, true);
            if (!$data) {
                return false;
            }

            // check system signature
            if (!isset($data['system_signature'])) {
                return false;
            }

            if ($data['system_signature'] !== $this->getSystemSignature()) {
                // License was for a different machine/domain!
                return false;
            }

            // check expiry if applicable
            if (isset($data['expires_at']) && $data['expires_at'] !== null) {
                if (now()->timestamp > $data['expires_at']) {
                    return false;
                }
            }

            return true;

        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Activate logic: verify and store.
     */
    public function activate(string $licenseKey): bool
    {
        if ($this->verifyLicense($licenseKey)) {
            // Save it
            Storage::put('license.key', $licenseKey);
            Cache::forget('app_license_status');
            return true;
        }
        return false;
    }

    /**
     * Get details of the current license.
     */
    public function getLicenseDetails(): ?array
    {
        $licenseKey = config('app.license_key');

        if (!$licenseKey && Storage::exists('license.key')) {
            $licenseKey = Storage::get('license.key');
        }

        if (!$licenseKey) {
            return null;
        }

        try {
            $parts = explode('.', trim($licenseKey));
            if (count($parts) !== 2) {
                return null;
            }

            $payloadJson = base64_decode($parts[0]);
            $data = json_decode($payloadJson, true);

            return $data;
        } catch (\Exception $e) {
            return null;
        }
    }
}
