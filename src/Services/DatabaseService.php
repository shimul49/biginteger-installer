<?php

namespace BigInteger\LaravelInstaller\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use PDO;
use Exception;

class DatabaseService
{
    /**
     * Setup database connection
     */
    public function setup(array $data): array
    {
        try {
            // Test the database connection
            $this->testConnection($data);

            // Update the .env file with database credentials
            $this->updateEnvironmentFile($data);

            // Run migrations
            $this->runMigrations();

            return [
                'status' => true,
                'message' => 'Database configured successfully'
            ];
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Test database connection
     */
    private function testConnection(array $data): void
    {
        $connection = new PDO(
            "mysql:host={$data['host']};dbname={$data['database_name']}",
            $data['username'],
            $data['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        // Force close the connection
        $connection = null;
    }

    /**
     * Update environment file
     */
    private function updateEnvironmentFile(array $data): void
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            $content = file_get_contents($path);

            $content = preg_replace('/DB_HOST=.*/', 'DB_HOST=' . $data['host'], $content);
            $content = preg_replace('/DB_DATABASE=.*/', 'DB_DATABASE=' . $data['database_name'], $content);
            $content = preg_replace('/DB_USERNAME=.*/', 'DB_USERNAME=' . $data['username'], $content);
            $content = preg_replace('/DB_PASSWORD=.*/', 'DB_PASSWORD=' . $data['password'], $content);

            file_put_contents($path, $content);
        }

        // Update the runtime configuration
        Config::set('database.connections.mysql.host', $data['host']);
        Config::set('database.connections.mysql.database', $data['database_name']);
        Config::set('database.connections.mysql.username', $data['username']);
        Config::set('database.connections.mysql.password', $data['password']);

        // Clear the database cache
        DB::purge('mysql');
    }

    /**
     * Run database migrations
     */
    private function runMigrations(): void
    {
        // Force the migrations to run
        DB::unprepared('SET FOREIGN_KEY_CHECKS=0;');
        
        $migrator = app('migrator');
        $migrator->run(database_path('migrations'));
        
        DB::unprepared('SET FOREIGN_KEY_CHECKS=1;');
    }
} 