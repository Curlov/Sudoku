<?php
// Authentications Controller, der alles ums Thema User, Login, Logout, Registrieren und Editieren steuert.
class ShowAuthenticationController extends BaseController
{

    /**
     * @param string $area
     * @param string $view
     */
    public function __construct(string $area,string $view) {
        parent::__construct($area);
        $this->view = $view;
    }

    /**
     * @param array $delivery
     * @return array
     */
    public function invoke(array $delivery = []) : array
    {
        // Der Teil der Authentication, der die Userdaten in die Datenbank einträgt und den User
        // im Erfolgsfall anmeldet, in dem er eine SESSION erstellt
        if ($this->area == 'authentication' && $this->view == 'insert') {
            try {
                //Sofern der Username noch nicht registriert ist
                if (!(new User())->isObjectRegistered($delivery['username'])) {
                    $passwordHash = (new User())->getPasswordHash($delivery['password']);
                    (new User)->enterObject($delivery['username'], $delivery['country'], $passwordHash);
                    $_SESSION['username'] = $delivery['username'];
                    return ['arrayName' => 'user', 'data' => [(new User)->getObjectByName($delivery['username'])]];
                } else {
                    return ['arrayName' => 'user', 'data' => $delivery];
                }
            } catch(Error $e) {
                throw new Exception($e);
            }

        // Wird der User ausgeloggt, werden die SESSIONS zerstört
        } elseif ($this->area == 'authentication' && $this->view == 'Logout') {
            session_unset();
            session_destroy();
            return ['arrayName' => 'user', 'data' => []];

        // Sollen die Userdaten editiert werden, werden die Userdaten gemäß dem Usernamen ausgelesen und als Array übergeben
        } elseif ($this->area == "authentication" && $this->view == 'Edit') {
            try {
                return ['arrayName' => 'user', 'data' => [(new User)->getObjectByName($_SESSION['username'])]];
            } catch(Error $e) {
                throw new Exception($e);
            }

        // Wenn die Userdaten editiert wurden und neu gespeichert werden sollen
        } elseif ($this->area == "authentication" && $this->view == 'Update') {
            try {
                $passwordHash = (new User())->getPasswordHash($delivery['password']);
                $user = (new User())->getObjectByName($_SESSION['username']);
                if ($user->usernameFree($delivery['username'], $user->getId())){
                    $_SESSION['username'] = $delivery['username'];
                    (new User)->updateObject($user->getId(), $delivery['username'], $delivery['country'], $passwordHash);
                    return ['arrayName' => 'user', 'data' => [(new User)->getObjectByName($delivery['username'])]];
                } else {
                    return ['arrayName' => 'user', 'data' => []];
                }
            } catch(Error $e) {
                throw new Exception($e);
            }

        // Login prüfung. Wenn es den User gibt und das Passwort zum Passwort-Hash passt, wird eine SESSION gesetzt
        } elseif ($this->area == "authentication" && $this->view == 'Login') {
            try {
                if (isset($delivery['username']) && isset($delivery['password'])) {
                    if ((new User)->isLoginOK($delivery['username'], $delivery['password'])) {
                        $_SESSION['username'] = $delivery['username'];
                        if ((new User)->isObjectAdmin($delivery['username'])) {
                            $_SESSION['admin'] = 1;
                        }
                        return ['arrayName' => 'user', 'data' => [(new User)->getObjectByName($delivery['username'])]];
                    }
                }
            } catch(Error $e) {
                throw new Exception($e);
            }
        }

        // Wenn keine der If-Abfragen greifen, wird ein leeres Array zurückgegeben
        return ['arrayName' => 'nothing', 'data' => []];
    }
}