<?php
class Db {
    /**
     * *
     * @dbh object
     */
    private static object $dbh;

    /**
     * @return object|PDO
     */
    public static function getConnection(): object {
        if (!isset(self::$dbh)) {
            try {
                self::$dbh = new PDO(DB_DSN, DB_USER, DB_PASSWD);
            } catch (PDOException $e) {
                throw new Exception($e);
            }
        }
        return self::$dbh;
    }
}