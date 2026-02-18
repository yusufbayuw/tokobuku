<?php

namespace App\Services\License;

class LicenseService extends \App\Support\SystemBoot
{
    public function checkLicense(): bool
    {
        return $this->v();
    }

    public function getSystemSignature(): string
    {
        return $this->sig();
    }

    public function verifyLicense(?string $k): bool
    {
        return $this->p($k);
    }

    public function activate(string $k): bool
    {
        return $this->store($k);
    }

    public function getLicenseDetails(): ?array
    {
        return $this->meta();
    }
}
