<?php

echo "Wellcome to php website<br>";




//creating configaration...

class config {
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
}






//Creating connection ...

include("config.php");
class Connection {
    function __construct() {
        echo 'I am working';
        //echo $host;
    }
        
    public function connect() {
        $config =  new Config();
        // we can create a db connection and return an object
        try {
            $conn = new PDO("mysql:host=$config->host;dbname=$config->database", $config->username, $config->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $conn;

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}

$connection = new Connection();
$connection = $connection->connect();






//creating DAL ...


include('connection.php');

class DAL {
    private $_connection;

    function __construct() {
        $connectionClass = new Connection();
        $this->_connection = $connectionClass->connect();

    }

    public function insert($argument) {
        $columns = '';
        $values = '';

        foreach($argument['values'] as $column_name => $column_value) {
            $columns .= "`". $column_name . "`,";
            $values .= "'". $column_value . "',";
        }

        $sql = "INSERT INTO " . $argument['table'] . " (";
        $sql .= rtrim($columns, ',') . ") ";
        $sql .= "VALUES (" . rtrim($values, ',') . ")";

        $this->_connection->exec($sql);

    }

    public function update() {

    }
    
    public function get() {

    }

    public function delete() {

    }
}

$dal = new DAL();
$dal->insert([
    'table' => 'task_type',
    'values' => [
        'projects_id' => 33,
        'name' => 'Instaily Testing',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ]
]);

$dal->insert([
    'table' => 'task_group',
    'values' => [
        'task_group_id' => 12,
        'group_name' => 'Instaily Group Name',
        'created_by' => 22,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ]
]);






//Creating database ...
$sql = "CREATE DATABASE trial1_insert ";
$result = mysqli_query($conn, $sql);

if ($result){
    echo "The db is created successfully...";
}

else {
    echo "The db was not created successfully ...error ... ".mysqli_connection_error($conn);
}







//Creating table ...
$sql = "CREATE TABLE `trial1_insert`.`user` (`sl.no` INT(6) NOT NULL AUTO_INCREMENT , `first_name` VARCHAR(12) NOT NULL  , `last_name` VARCHAR(12) NOT NULL , PRIMARY KEY (`sl.no`))";
$result = mysqli_query($conn, $sql);

if ($result){
    echo "The table was created successfully<br>";

}
else {
    echo "The table was not created ...error ..".mysqli_error($conn);
}


//Inserting values...
$sql = "INSERT INTO `trial1_insert` (`sl.no`, `first_name` , `last_name`)  VALUES (`1`, `Soura Kishore`, `Bhattacharya`)";
$result = mysqli_query($conn, $sql);

if ($result){
    echo "The values were inserted seccessfully...";
}

else {
    echo "The values were not inserted ...error...".mysqli_error($conn);
}

?>
