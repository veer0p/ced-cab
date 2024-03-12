<?php
class dbcon
{
    public $dbhost;
    public $dbuser;
    public $dbpass;
    public $dbname;
    public $conn;

    function __construct()
    {
        $this->dbhost = "localhost";
        $this->dbuser = "veer";
        $this->dbpass = "@Veer.idk";
        $this->dbname = "veer";

        $this->conn = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // You can add more methods or functionality to this class as needed.

    function closeConnection()
    {
        $this->conn->close();
    }
}

// Example usage:
$database = new dbcon();
// Now $database->conn is the active database connection.

// ...

// Don't forget to close the connection when you are done.
$database->closeConnection();
?>
