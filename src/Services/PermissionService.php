<?php

namespace BigInteger\LaravelInstaller\Services;

class PermissionService
{
    /**
     * Check directory permissions
     */
    public function check(): array
    {
        $paths = [
            'storage/app' => storage_path('app'),
            'storage/framework' => storage_path('framework'),
            'storage/logs' => storage_path('logs'),
            'bootstrap/cache' => base_path('bootstrap/cache'),
            '.env' => base_path('.env')
        ];

        $results = [];

        foreach ($paths as $key => $path) {
            $results[] = [
                'name' => $key,
                'path' => $path,
                'writable' => $this->isWritable($path),
                'permission' => $this->getPermission($path)
            ];
        }

        return $results;
    }

    /**
     * Check if the path is writable
     */
    private function isWritable(string $path): bool
    {
        if (is_file($path)) {
            return is_writable($path);
        }
        
        return is_writable($path) && $this->isDirectoryWritable($path);
    }

    /**
     * Check if directory and its contents are writable
     */
    private function isDirectoryWritable(string $path): bool
    {
        if (!is_dir($path)) {
            return false;
        }

        $directory = new \RecursiveDirectoryIterator($path);
        $iterator = new \RecursiveIteratorIterator($directory);
        
        foreach ($iterator as $file) {
            if ($file->isFile() && !$file->isWritable()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get permission string
     */
    private function getPermission(string $path): string
    {
        return substr(sprintf('%o', fileperms($path)), -4);
    }
} 