<?php


class Database
{
    /**
     * @var mysqli
     */
    private $connection;

    public function __construct()
    {
        $serverHost = "127.0.0.1";
        $userName = "root";
        $password = "";
        $databaseName = "nowa";
        $databasePort = "3306";
        $conn = mysqli_connect(
            $serverHost,
            $userName,
            $password,
            $databaseName,
            $databasePort
        );
        $this->connection = $conn;
    }

    /**
     * @param string $email
     * @param string $password
     * @return string
     */
    public function findUserByEmailAndPassword(
        string $email,
        string $password
    ){
        $query = "SELECT email, password FROM users 
                  WHERE email="."'"."$email"."'"."
                  AND password="."'"."$password"."'";
        $result = $this->connection->query($query);
        if ($result === false){
            return false;
        } elseif ($result->num_rows === 1) {
            return true;
        }
        return false;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function findUserByEmail(
        string $email
    ){
        $query = "SELECT email FROM users 
                  WHERE email="."'"."$email"."'";
        $result = $this->connection->query($query);
        if ($result === false){
            return false;
        } elseif ($result->num_rows === 1) {
            return true;
        }
        return false;
    }

    /**
     * @param User $user
     */
    public function addUserToDatabase(
        User $user
    ){
        $query = "INSERT INTO users (email, password)
                  VALUES ("."'".$user->getEmail()."', '".$user->getPassword()."'".")";
        $this->connection->query($query);
    }
}

