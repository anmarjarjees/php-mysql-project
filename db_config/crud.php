<?php
/*
This php file is just for instantiate our object from the Database Class
to do the CRUD operation, so let's name it $crud
*/
require_once 'db_conn.php'; // to get the object "$pdo"
require_once 'Database.php'; // to get our class "Database"

// Starting our crud object:
// Remember that we modified the constructor method of our class "Database"
// The constructor method requires one argument which is the PDO object
// in our connection file, we named it "pdo"
$crud = new Database($pdo);
