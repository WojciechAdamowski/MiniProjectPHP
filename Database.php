<?php


class Database
{
    private $fileName = 'users.txt';

    /**
     * @return array|false
     */
    private function getDatabase(){
        return file(
            $this->fileName,
            FILE_IGNORE_NEW_LINES
        );
    }

    /**
     * @return User[]
     */
    private function getAllUsers(){
        $usersFromDatabase = $this->getDatabase();
        $users = [];

        $email = 0;
        $password = 1;
        foreach ($usersFromDatabase as $user){
            $user = explode(':', $user);
            $users[] = new User($user[$email], $user[$password]);
        }
        return $users;
    }

    /**
     * @param User $user
     */
    public function addUserToDatabase(
        User $user
    ){
        file_put_contents(
            'users.txt',
            $user->getEmail() . ':' . $user->getPassword() . "\n",
            FILE_APPEND,
            null
        );
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function findUserByLoginDetails(
        string $email,
        string $password
    ){
        $users = $this->getAllUsers();
        if (count($users) > 0){
            foreach ($users as $user){
                if (
                    $email === $user->getEmail() &&
                    $password === $user->getPassword()
                ){
                    return true;
                }
            }
            return false;
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
        $users = $this->getAllUsers();
        if (count($users) > 0){
            foreach ($users as $user){
                if ($email === $user->getEmail()){
                    return true;
                }
            }
        }
        return false;
    }
}

