<?php

namespace Model;

class UserModel extends Model
{

    public function createUser(string $name, string $email): int
    {
        $stmt = $this->db->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $email);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function checkExistEmail(string $email): ?int
    {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['id'] ?? null;
    }
}