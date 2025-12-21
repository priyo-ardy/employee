<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'user_name' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => false,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'user_email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'email_hash' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'user_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'phone_hash' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'user_password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'user_photo' => [
                'type' => "VARCHAR",
                'constraint' => 255,
                'null' => true,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'login_attempt' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'default' => 0,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'user_status' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'default' => 1,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'user_level' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
                'default' => 0,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'remark' => [
                'type' => "TEXT",
                'null' => true,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'last_login' => [
                'type' => 'DATETIME',
                'null' => true,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'login_from' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'created_by' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'updated_by' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
            ],
        ]);

        $this->forge->addKey(['user_id', 'user_name', 'email_hash', 'phone_hash'], true, true, 'idx_user_data');
        $this->forge->createTable('m_user_auth', true);
    }

    public function down()
    {
        $this->forge->dropTable('m_user_auth', true);
    }
}
