<?php

class User
{
    /**
     * @var int
     */
    private ?int $id;

    /**
     * @var string
     */
    private ?string  $username;

    /**
     * @var string
     */
    private ?string $password;

    /**
     * @var string
     */
    private ?string $country;

    public function __construct(int $id = null, string $username = null, string $country = null, string $password = null)
    {
        if(isset($id)) {
            $this->id = $id;
            $this->username = $username;
            $this->country = $country;
            $this->password = $password;
        }
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getAdmin(): int
    {
        return $this->admin;
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

    /**
     * @param int $id
     * @param string $username
     * @param string $country
     * @param string $passwordHash
     * @return void
     */
    public function updateObject(int $id, string $username, string $country, string $passwordHash): void
    {
            $pdo = Db::getConnection();
            $sql = 'UPDATE users SET username=:username, country=:country, passwordHash=:passwordHash WHERE id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':passwordHash', $passwordHash);
            $stmt->execute();
    }

    function getObjectByName(string $username): object
    {
        $pdo = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE username=:username';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchObject('User');
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    function isLoginOK(string $username, string $password): bool
    {
        $pdo = Db::getConnection();
        $sql = 'SELECT * FROM users WHERE username = :username';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return false;
        } else {
            if (password_verify($password, $result['passwordHash'])) {
                return true;
            } else {
                return false;
            }
        }
    }

    function isObjectAdmin(string $username):bool
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
            if ($result['admin'] == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    function usernameFree(string $newName, int $id): bool
    {
        $pdo = Db::getConnection();
        $sql = 'SELECT COUNT(*) FROM users WHERE username = :newName AND id != :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':newName', $newName);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
       return $stmt->fetchColumn() == 0;
    }

}