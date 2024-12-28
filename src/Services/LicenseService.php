<?php

namespace BigInteger\LaravelInstaller\Services;

class LicenseService
{
    /**
     * Verify purchase code
     */
    public function verify(string $purchaseCode): array
    {
        // Here you would typically make an API call to verify the purchase code
        // This is a placeholder implementation
        return [
            'status' => true,
            'message' => 'Purchase code verified successfully'
        ];
    }

    /**
     * Generate license key
     */
    public function generate(string $ip, string $host, string $machineId): string
    {
        // Generate a unique license key based on the provided parameters
        $data = $ip . $host . $machineId;
        return hash('sha256', $data);
    }

    /**
     * Get machine ID
     */
    public function getMachineId(): string
    {
        if (PHP_OS === 'Linux') {
            return $this->getLinuxMachineId();
        }
        
        // Fallback to a combination of hostname and PHP_OS
        return hash('sha256', php_uname() . PHP_OS);
    }

    /**
     * Get Linux machine ID
     */
    private function getLinuxMachineId(): string
    {
        $machineId = '/etc/machine-id';
        if (file_exists($machineId) && is_readable($machineId)) {
            return trim(file_get_contents($machineId));
        }
        
        return hash('sha256', php_uname());
    }
} 