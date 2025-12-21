<?php

use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

if (!function_exists('generate_uuid')) {
    function generate_uuid(): string
    {
        $data = random_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // versi 4
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // varian 10xx

        return sprintf(
            '%s-%s-%s-%s-%s',
            bin2hex(substr($data, 0, 4)),
            bin2hex(substr($data, 4, 2)),
            bin2hex(substr($data, 6, 2)),
            bin2hex(substr($data, 8, 2)),
            bin2hex(substr($data, 10, 6))
        );
    }
}

if (!function_exists('generate_random_code')) {
    function generate_random_code($length = 8)
    {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        $random_code = '';

        for ($i = 0; $i < $length; $i++) {
            $random_code .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $random_code;
    }
}

if (!function_exists('system_info')) {
    function system_info()
    {
        $db = \Config\Database::connect();
        $dbDriver = $db->getPlatform();

        // Untuk mendapatkan versi database
        try {
            if ($dbDriver === 'MySQLi') {
                $version = $db->query('SELECT VERSION() as version')->getRow()->version;
            } elseif ($dbDriver === 'Postgre') {
                $version = $db->query('SELECT version()')->getRow()->version;
            } else {
                $version = 'Unknown';
            }
        } catch (\Exception $e) {
            $version = 'Error: ' . $e->getMessage();
        }

        return [
            'PHP Version' => phpversion(),
            'CodeIgniter Version' => \CodeIgniter\CodeIgniter::CI_VERSION,
            'Database Driver' => $dbDriver,
            'Database Version' => $version,
            'OS' => php_uname('s') . ' ' . php_uname('r'),
            'Server Software' => $_SERVER['SERVER_SOFTWARE'] ?? 'N/A',
            'Server Name' => $_SERVER['SERVER_NAME'] ?? 'N/A',
            'Environment' => ENVIRONMENT,
            'server_ip' => $_SERVER['SERVER_ADDR'] ?? 'N/A',
            'client_ip' => $_SERVER['REMOTE_ADDR'] ?? 'N/A',
            'php_memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time'),
            'loaded_extensions' => implode(', ', get_loaded_extensions()),
        ];
    }
}

if (!function_exists('current_url')) {
    function current_url()
    {
        // Mendapatkan objek request
        $request = service('request');
        // Mendapatkan current URL
        $currentUrl = $request->getUri()->getScheme() . '://' . $request->getUri()->getHost() . $request->getUri()->getPath();
        // Jika Anda juga ingin menambahkan query string
        $currentUrl .= $request->getUri()->getQuery() ? '?' . $request->getUri()->getQuery() : '';
        // Menampilkan current URL
        return $currentUrl;
    }
}

if (!function_exists('pesan')) {
    function pesan(string $error_code, string $message, $data =  null)
    {
        $response = service('response');
        return $response
            ->setStatusCode($error_code)
            ->setJSON([
                'status' => $error_code,
                'message' => $message,
                'data' => $data
            ], JSON_PRETTY_PRINT);
    }
}

if (!function_exists('enkripsi')) {
    function enkripsi($value)
    {
        $encrypter = service('encrypter');

        return base64_encode($encrypter->encrypt($value));
    }
}

if (!function_exists('dekripsi')) {
    function dekripsi($value)
    {
        $decrypter = service('encrypter');


        return $decrypter->decrypt(base64_decode($value));
    }
}

if (!function_exists('phone_hash')) {
    function phone_hash(string $phone_number)
    {
        $secret_key = getenv('phone_salt');
        return hash('sha256', $secret_key . $phone_number);
    }
}

if (!function_exists('email_hash')) {
    function email_hash(string $email_address)
    {
        $secret_key = getenv('email_salt');
        return hash('sha256', $secret_key . $email_address);
    }
}

if (!function_exists('validasi_form')) {
    /**
     * Validate the request with given rules.
     *
     * @param array<string, array<string, mixed>> $rules
     * @return bool
     * @throws \CodeIgniter\Exceptions\Psr7\NotFoundException
     */
    function validasi_form(array $rules): bool
    {
        $validasi = service('validation');
        $request = service('request');

        $validasi->setRules($rules);

        if (!$validasi->withRequest($request)->run()) {
            $error_message = implode("<br>", $validasi->getErrors());
            return pesan(ResponseInterface::HTTP_BAD_REQUEST, $error_message);
        }

        return true;
    }
}
