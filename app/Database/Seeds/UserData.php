<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserData extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_id' => generate_uuid(),
                'user_name' => '0092',
                'full_name' => 'Ardy Priyo Sudiyantoko',
                'user_email' => enkripsi('priyo.ardy@schlemmer.co.id'),
                'email_hash' => email_hash('priyo.ardy@schlemmer.co.id'),
                'user_phone' => enkripsi('081210192858'),
                'phone_hash' => phone_hash('081210192858'),
                'user_password' => password_hash("ardy9004", PASSWORD_DEFAULT),
                'login_attempt' => 0,
                'user_status' => 1,
                'user_level' => 0,
                'remark' => "From imported data"
            ],
            [
                'user_id' => generate_uuid(),
                'user_name' => 'admin',
                'full_name' => 'Administrator',
                'user_email' => enkripsi('admin@schlemmer.co.id'),
                'email_hash' => email_hash('admin@schlemmer.co.id'),
                'user_phone' => enkripsi('087878475545'),
                'phone_hash' => phone_hash('087878475545'),
                'user_password' => password_hash("admin123", PASSWORD_DEFAULT),
                'login_attempt' => 0,
                'user_status' => 1,
                'user_level' => 1,
                'remark' => "From imported data"
            ],
            [
                'user_id' => generate_uuid(),
                'user_name' => 'user',
                'full_name' => 'User',
                'user_email' => enkripsi('user@schlemmer.co.id'),
                'email_hash' => email_hash('user@schlemmer.co.id'),
                'user_phone' => enkripsi('081234567890'),
                'phone_hash' => phone_hash('081234567890'),
                'user_password' => password_hash("user123", PASSWORD_DEFAULT),
                'login_attempt' => 0,
                'user_status' => 1,
                'user_level' => 9,
                'remark' => "From imported data"
            ]
        ];

        $this->db->table('m_user_auth')->insertBatch($data);
    }
}
