<?php

class User
{

    # Database handler
    private $dbh;
    private $session_expires_in_days = 30;
    private $input_min_lenght = 6;
    private $input_max_lenght = 35;

    public function __construct(object $dbh)
    {
        /**
         * Requires PDO Database Handler for initialization
         */
        session_start();
        $this->dbh = $dbh;
    }

    /**
     * @throws Exception Invalid strlen
     */
    private function validate_input_size(string $validate)
    {
        if (strlen($validate) < $this->input_min_lenght || strlen($validate) > $this->input_max_lenght) {
            throw new Exception("User registration exception: email and password must be between 6 and 35 characters in length");
        }
    }

    /**
     * @throws Exception Invalid Password Strength
     */
    private function validate_pwd_strength(string $password)
    {
        # Password Validation
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $special_chars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$special_chars) {
            throw new Exception("User registration exception: Password should include at least one upper case letter, one number, and one special character.");
        }
    }

    /**
     * @throws Exception Invalid Email
     */
    private function validate_email(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("User registration exception: invalid email, please try again");
        }
    }


    function register(string $email, string $password, string $role): array
    {
        $this->validate_input_size($email);
        $this->validate_input_size($password);
        $this->validate_email($email);
        $this->validate_pwd_strength($password);

        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sth = $this->dbh->prepare("INSERT INTO `users` (`email`,`password`,`role`) VALUES (?,?,?)");
            $sth->execute([$email, $hashed_password, $role]);
            return ["result" => "ok", "msg" => "Se agrego el usuario {$email} con exito"];
        } catch (PDOException $e) {
            return ["result" => "exception", "msg" => $e->getMessage()];
        }
    }

    /**
     * @throws Exception "Wrong Credentials"
     */
    function login(string $email, string $password)
    {
        $this->validate_input_size($email);
        $this->validate_input_size($password);
        $this->validate_email($email);
        try {
            $sth = $this->dbh->prepare("SELECT * FROM users WHERE email = ?");
            $sth->execute([$email]);
            $user = $sth->fetch();
            if (($user) && (password_verify($password, $user['password']))) {
                $_SESSION['auth'] = True;
                $_SESSION['email'] = $email;
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + ($this->session_expires_in_days * 24 * 60 * 60);
            } else {
                $_SESSION['auth'] = False;
                throw new Exception("Login exception: Wrong credentials, please try again");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    static function logout()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        session_destroy();
        session_write_close();
    }


    function is_auth(): bool
    {
        $session = ($_SESSION['auth'] ?? False);
        $now = time();
        if ($session && ($now > $_SESSION['expire'])) {
            User::logout();
            return false;
        }
        return $session;

    }

    function fetchAll(int $limit, string $order): array
    {
        try {
            $sth = $this->dbh->prepare("SELECT id, email, role, created FROM users ORDER BY id {$order} LIMIT {$limit}");
            $sth->execute();
            $users = $sth->fetchAll();
            return $users;
        } catch (PDOException $e) {
            echo "Fetch Users Exception: {$e->getMessage()}";
        }
    }

    function email(): string
    {
        return ($_SESSION['email'] ?? '');
    }
}