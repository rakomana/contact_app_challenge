<?php

require 'config\db_connection.php';

class Contact{

    /**
     * Execute queries
     * @param $query
     * @return array
    */
    public function query(string $query)
    {
        global $conn;
        $result = false;

        try {
            $result = mysqli_query($conn, $query);
            return $result;
        } catch (Exception $ex) {
            $this->error = $ex->getMessage();
            return false;
        }
    }

    /**
     * validate input
    */
    public function validate(string $value)
    {
        global $conn;
        $result = false;

        try{
            $result = mysqli_real_escape_string($conn, htmlspecialchars($value));
            return $result;
        } catch(Exception $ex) {
            $this->error = $ex->getMessage();
            return false;
        }
    }
}