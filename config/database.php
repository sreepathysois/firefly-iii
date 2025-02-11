<?php
/**
 * database.php
 * Copyright (c) 2019 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III (https://github.com/firefly-iii).
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);


$databaseUrl = getenv('DATABASE_URL');
$host        = '172.16.51.41';
$username    = 'soisuser';
$password    = 'Sois@123';
$database    = 'soisdb';
$port        = '3306';

if (!(false === $databaseUrl)) {

    $options  = parse_url($databaseUrl);
    $host     = $options['host'] ?? 'firefly_iii_db';
    $username = $options['user'] ?? 'firefly';
    $port     = $options['port'] ?? '5432';
    $password = $options['pass'] ?? 'secret_firefly_password';
    $database = substr($options['path'] ?? '/firefly', 1);
}

return [

    'default'     => envNonEmpty('DB_CONNECTION', 'mysql'),
    'connections' => [
        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => envNonEmpty('DB_DATABASE', storage_path('database/database.sqlite')),
            'prefix'   => '',
        ],
        'mysql'  => [
            'driver'      => 'mysql',
            'host'        => envNonEmpty('DB_HOST', $host),
            'port'        => envNonEmpty('DB_PORT', $port),
            'database'    => envNonEmpty('DB_DATABASE', $database),
            'username'    => envNonEmpty('DB_USERNAME', $username),
            'password'    => env('DB_PASSWORD', $password),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset'     => 'utf8mb4',
            'collation'   => 'utf8mb4_unicode_ci',
            'prefix'      => '',
            'strict'      => true,
            'engine'      => 'InnoDB',
        ],
        'pgsql'  => [
            'driver'      => 'pgsql',
            'host'        => envNonEmpty('DB_HOST', $host),
            'port'        => envNonEmpty('DB_PORT', $port),
            'database'    => envNonEmpty('DB_DATABASE', $database),
            'username'    => envNonEmpty('DB_USERNAME', $username),
            'password'    => env('DB_PASSWORD', $password),
            'charset'     => 'utf8',
            'prefix'      => '',
            'schema'      => 'public',
            'sslmode'     => envNonEmpty('PGSQL_SSL_MODE', 'prefer'),
            'sslcert'     => envNonEmpty('PGSQL_SSL_CERT'),
            'sslkey'      => envNonEmpty('PGSQL_SSL_KEY'),
            'sslrootcert' => envNonEmpty('PGSQL_SSL_ROOT_CERT'),
        ],
        'sqlsrv' => [
            'driver'   => 'sqlsrv',
            'host'     => env('DB_HOST', 'localhost'),
            'port'     => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
        ],

    ],
    'migrations'  => 'migrations',
    'redis'       => [
        'client'  => 'predis',
        'default' => [
            'host'     => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port'     => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];
