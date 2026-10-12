<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected string $table = 'users';
    protected array $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'avatar',
        'status',
        'created_at',
        'updated_at'
    ];

    public function findByEmail(string $email): ?array
    {
        return $this->findWhere('email', $email);
    }

    public function createCustomer(array $data): int|string
    {
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['role'] = $data['role'] ?? 'customer';
        $data['status'] = $data['status'] ?? 'active';
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->create($data);
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}