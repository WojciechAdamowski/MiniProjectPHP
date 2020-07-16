<?php


class User
{
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;

    /**
     * User constructor.
     * @param string $email
     * @param string $password
     */
    public function __construct(
        string $email,
        string $password
    )
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(){
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * Display user info about user
     */
    public function showInfo(){
        echo "Email: $this->email \n";
        echo "Password: $this->password \n";
    }
}