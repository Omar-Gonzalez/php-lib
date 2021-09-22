<?php

class User
{

    # Database handler
    private $dbh;

    public function __construct(object $dbh)
    {
        /**
         * Requires PDO Database Handler for initialization
         */
        session_start();
        $this->dbh = $dbh;
    }

    /**
     * @throws Exception "Invalid Email or Weak Password"
     */
    function register(string $email, string $password)
    {
        # Email Validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("User registration exception: invalid email, please try again");
        }
        # Password Validation
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 6) {
            throw new Exception("User registration exception: Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.");
        }
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sth = $this->dbh->prepare("INSERT INTO `users` (`email`,`password`) VALUES (?,?)");
            $sth->execute([$email, $hashed_password]);
        } catch (PDOException $e) {
            echo "User registration exception: " . $e->getMessage();
        }
    }

    /**
     * @throws Exception "Wrong Credentials"
     */
    function login(string $email, string $password)
    {
        try {
            $sth = $this->dbh->prepare("SELECT * FROM users WHERE email = ?");
            $sth->execute([$email]);
            $user = $sth->fetch();
            if (($user) && (password_verify($password, $user['password']))) {
                $_SESSION['auth'] = True;
                $_SESSION['email'] = $email;
            } else {
                $_SESSION['auth'] = False;
                throw new Exception("Login exception: Wrong credentials, please try again");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function logout()
    {
        $_SESSION['auth'] = False;
        session_destroy();
    }


    function is_auth(): bool
    {
        return ($_SESSION['auth'] ?? False);
    }

    function email(): string
    {
        return ($_SESSION['email'] ?? '');
    }
}