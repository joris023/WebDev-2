<?php
namespace Models;

class User {

    public int $id;
    public string $firstname;
    public string $password;
    public string $email;
    public string $role;
    public string $refreshtoken;
}

?>