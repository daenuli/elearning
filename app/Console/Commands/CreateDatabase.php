<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;
use PDOException;

/**
 * Class CreateDatabase
 */
class CreateDatabase extends Command
{
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tries to create the database if it doesn\'t exist yet.';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elearning:create-database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        if ('mysql' !== env('DB_CONNECTION', 'mysql')) {
            $this->info(sprintf('CreateDB does not apply to "%s", skipped.', env('DB_CONNECTION')));

            return 0;
        }
        // try to set up a raw connection:
        $pdo     = false;
        $exists  = false;
        $checked = false; // checked for existence of DB?
        $dsn     = sprintf('mysql:host=%s;port=%d;charset=utf8mb4', env('DB_HOST', 'localhost'), env('DB_PORT', '3306'));

        if ('' !== env('DB_SOCKET', '')) {
            $dsn = sprintf('mysql:unix_socket=%s;charset=utf8mb4', env('DB_SOCKET', ''));
        }
        $this->info(sprintf('DSN is %s', $dsn));

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        // when it fails, display error
        try {
            $pdo = new PDO($dsn, env('DB_USERNAME'), env('DB_PASSWORD'), $options);
        } catch (PDOException $e) {
            $this->error(sprintf('Error when connecting to DB: %s', $e->getMessage()));
        }

        // only continue when no error.
        if (false !== $pdo) {
            // with PDO, try to list DB's (
            $stmt    = $pdo->query('SHOW DATABASES;');
            $checked = true;
            // slightly more complex but less error prone.
            foreach ($stmt as $row) {
                $name = $row['Database'] ?? false;
                if ($name === env('DB_DATABASE')) {
                    $exists = true;
                }
            }
        }
        if (false === $exists && true === $checked) {
            $this->error(sprintf('Database "%s" does not exist.', env('DB_DATABASE')));

            // try to create it.
            $pdo->exec(sprintf('CREATE DATABASE `%s` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;', env('DB_DATABASE')));
            $this->info(sprintf('Created database "%s"', env('DB_DATABASE')));
        }
        if (true === $exists && true === $checked) {
            $this->info(sprintf('Database "%s" exists.', env('DB_DATABASE')));
        }

        return 0;
    }
}