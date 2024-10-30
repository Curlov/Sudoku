<?php

class User
{
    /**
     * @var string
     */
    private string  $username;

    /**
     * @var string
     */
    private string $password;

    /**
     * @var string
     */
    private string $country;

    public function __construct($username = 0, $country = 0, $password = 0)
    {
        $this->username = $username;
        $this->country = $country;
        $this->password = $password;
    }

    public function getpasswordHash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteObjectById(int $id): void
    {
        $pdo = Db::getConnection();
        $sql = 'DELETE FROM users WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    /**
     * @param string $username
     * @param string $country
     * @param string $passwordHash
     * @return void
     */
    public function enterObject(string $username, string $country, string $passwordHash): void
    {
        $pdo = Db::getConnection();
        $sql = 'INSERT INTO users (username, country, passwordHash) VALUES (:username, :country, :passwordHash)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':passwordHash', $passwordHash);
        $stmt->execute();
    }

    /**
     * @param string $username
     * @return array
     */
    function isObjectRegistered(string $username):bool
    {
        $pdo = Db::getConnection();
        $sql = 'SELECT username FROM users WHERE username = :username';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return false;
        } else {
            return true;
        }
    }

    function getObjectByName(string $username):array
    {
        $pdo = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE username = :username';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    function isLoginOK(string $username, string $password):bool
    {
        $pdo = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE username = :username';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($result)){
            return false;
        } else {
            if (password_verify($password, $result['hashedPassword'])) {
                return $result;
            } else {
                return false;
            }
        }
    }

}