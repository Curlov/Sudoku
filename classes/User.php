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

    /**
     * @param string $password
     * @return string
     */
    // Gibt für das übergebene Password, den entsprechenden Password-Hash zurück.
    public function getpasswordHash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return int
     */
    // Gibt die ID zurück
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return void
     */
    // Löscht den User via ID aus der Datenbank.
    public function deleteObjectById(int $id): void
    {
        try {
            $pdo = Db::getConnection();
            $sql = 'DELETE FROM users WHERE id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch(Error $e) {
            throw new Exception($e);
        }
    }

    /**
     * @param string $username
     * @param string $country
     * @param string $passwordHash
     * @return void
     */
    // Trägt einen User in die Datenbank ein.
    public function enterObject(string $username, string $country, string $passwordHash): void
    {
        try {
            $pdo = Db::getConnection();
            $sql = 'INSERT INTO users (username, country, passwordHash) VALUES (:username, :country, :passwordHash)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':passwordHash', $passwordHash);
            $stmt->execute();
        } catch(Error $e) {
            throw new Exception($e);
        }
    }

    /**
     * @param string $username
     * @return array
     */
    // Prüft, ob ein Username bereits in der Datenbank vorhanden ist.
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
    // Ein User-Datenbank-Eintrag wird geupdatet oder überschrieben
    public function updateObject(int $id, string $username, string $country, string $passwordHash): void
    {
        try {
            $pdo = Db::getConnection();
            $sql = 'UPDATE users SET username=:username, country=:country, passwordHash=:passwordHash WHERE id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':passwordHash', $passwordHash);
            $stmt->execute();
        } catch(Error $e) {
            throw new Exception($e);
        }
    }
    /**
     * @param string $username
     * @return object|false|stdClass|User|null
     * @throws Exception
     */
    // Gibt die Userdaten nach Usernamen zurück
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
    // Prüft, ob der übergebenene Username in der Datenbank vorhanden ist und ob das Password
    // mit dem gespeicherten Passwordhash verifiziert werden kann
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
    /**
     * @param string $username
     * @return bool
     * @throws Exception
     */
    // Prüft, ob der User einen Admin-Status hat.
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
    /**
     * @param string $newName
     * @param int $id
     * @return bool
     * @throws Exception
     */
    // Prüft, ob der übergebenen Username nicht unter einer anderen ID vorhanden ist.
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