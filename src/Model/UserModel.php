<?php

namespace Model;

class UserModel extends Model
{

    public function createUser(string $name, string $email, string $password): int
    {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function checkExistEmail(string $email): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as counter FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
//        dd($row);
        return $row['counter'] ==1;
    }
}