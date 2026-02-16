<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateLicense extends Command
{
    protected $signature = 'license:create {signature : The system signature from the target machine} {--expires= : YYYY-MM-DD expiry date}';
    protected $description = 'Create a license key for a specific machine signature';

    public function handle()
    {
        $targetSignature = $this->argument('signature');
        $expires = $this->option('expires');

        $payload = [
            'system_signature' => $targetSignature,
            'client_name' => 'Licensed Client',
            'created_at' => now()->timestamp,
            'expires_at' => $expires ? strtotime($expires) : null,
        ];

        // Load private key
        $privateKeyPath = base_path('private_key.pem');
        if (!file_exists($privateKeyPath)) {
            $this->error("Private key not found at: $privateKeyPath");
            return 1;
        }

        $privateKey = file_get_contents($privateKeyPath);
        $payloadJson = json_encode($payload);

        // Sign
        openssl_sign($payloadJson, $signature, $privateKey, OPENSSL_ALGO_SHA256);

        // Encode
        $licenseKey = base64_encode($payloadJson) . '.' . base64_encode($signature);

        $this->info("License Key for Signature [$targetSignature]:");
        $this->line($licenseKey);

        return 0;
    }
}
