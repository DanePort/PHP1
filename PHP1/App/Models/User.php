<?php

namespace App\Models;

use Core\Model;
use PDO;


class User extends Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public function __construct($data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }


    public static function authenticate($email, $password)
    {
        $user = self::find_by_email($email);
        if ($user){
            if (password_verify($password, $user->PasswordHash)){
                return $user;
            }
        }
        return false;
    }

    public static function find_by_email($email)
    {
        $sql = 'SELECT * FROM phpApp_users WHERE user_email = ?';
        $stmt = self::execute_select_query($sql, PDO::FETCH_CLASS ,[$email]);
        return $stmt->fetch();
    }

    public function register_user()
    {
        $this->validate();

        if (empty($this->errors)){

            if (empty($this->Type)){
                $this->Type = 'customer';
            }

            $sql = 'INSERT INTO phpApp_Users (username, user_type, user_password, user_email) VALUES (?, ?, ?, ?)';
            $parameters = [$this->Name, $this->Type, $this->$Password, $this->Email];

            return self::execute_edit_query($sql, $parameters);
        }

        return false;
    }

    /**
     * @param string $name Full name
     * @return array An array with the first name at index 0 and last name at index 1
     */

    /**
     * Validate property values, adding error messages to the errors array property
     * @return void
     */
    private function validate()
    {
        if (strlen($this->Password) < 6)
            $this->errors[] = 'Please enter at least 6 characters for the Password';

        if (preg_match('/.*[a-z]+.*/i', $this->Password) == 0)
            $this->errors[] = 'Password needs at least one letter';

        if (preg_match('/.*\d+.*/i', $this->Password) == 0)
            $this->errors[] = 'Password needs at least one number';
        
    }
}
