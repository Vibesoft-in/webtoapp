<?php

declare(strict_types=1);

namespace App\Core;

use PDO;

abstract class Model
{
    protected PDO $db;
    protected string $table = '';
    protected string $primaryKey = 'id';
    protected array $fillable = [];

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY {$this->primaryKey} DESC");
        return $stmt->fetchAll();
    }

    public function find(int|string $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function where(string $column, mixed $value): array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$column} = :val");
        $stmt->execute(['val' => $value]);
        return $stmt->fetchAll();
    }

    public function findWhere(string $column, mixed $value): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$column} = :val LIMIT 1");
        $stmt->execute(['val' => $value]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    public function create(array $data): int|string
    {
        $filtered = array_intersect_key($data, array_flip($this->fillable));
        $columns = implode(', ', array_keys($filtered));
        $placeholders = ':' . implode(', :', array_keys($filtered));

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($filtered);

        return $this->db->lastInsertId();
    }

    public function update(int|string $id, array $data): bool
    {
        $filtered = array_intersect_key($data, array_flip($this->fillable));
        $setClauses = [];
        foreach ($filtered as $key => $val) {
            $setClauses[] = "{$key} = :{$key}";
        }
        $setClause = implode(', ', $setClauses);
        $filtered['id'] = $id;

        $sql = "UPDATE {$this->table} SET {$setClause} WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($filtered);
    }

    public function delete(int|string $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id");
        return $stmt->execute(['id' => $id]);
    }
}