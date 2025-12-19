<?php

namespace App\Models\Auth;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table            = 'm_user_auth';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'user_name',
        'full_name',
        'user_email',
        'email_hash',
        'user_phone',
        'phone_hash',
        'user_password',
        'login_attempt',
        'user_status',
        'user_level',
        'remark',
        'last_login',
        'login_from',
        'created_at',
        'updated_at',
        'updated_by',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getUserData($email_hash)
    {
        return $this->where('email_hash', $email_hash, true)->first();
    }
}
