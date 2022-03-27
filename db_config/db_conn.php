<?php
// Connecting to Database using PDO
/*
PDO object represent the database connection
using the constructor: new PDO()

Example:
$db = new PDO();

But we need to pass some values to have the PDO to work!
Example:
$db = new PDO(dsn, username, password);

So the DPO constructor needs or takes what's known as "DSN" (Data Source Name)
and the username and the password

DSN includes:
- mysql:
- host=localhost;
- dbname=users;

PDO is the ideal way to work with modern Databases using PHP
*/

// The host server 'localhost':
$host = 'localhost:3307';
// Or using the IP address:
// $host='127.0.0.1';

// The name of our database
$db = 'web_workshop';

// Adding the credentials
$user='root';
$password='root123';

// $charset='utf8mb4'; // UTF8 Unicode Multilingual Case Insensitive
// define "data source name"
// our database is MySQL as PDO supports different databases
// Please make sure to remove any spaces after the ;
$dsn = "mysql:host=$host;dbname=$db";

// apply try catch statement
try { // trying to connect to database
    // creating a new instance of PDO class:
    $pdo = new PDO($dsn, $user, $password);

    /*
    We can also add a predefined attributes to the PDO object:
    **********************************************************
    These predefined attributes can help us as programmers to control how PDO object is going to behave in certain ways

    PDO::setAttribute => Sets an attribute on the database handle
    Description: bool PDO::setAttribute ( $attribute, $value );
    - setAttribute() is a method that belongs to the PDO object
    - This method is used to set a predefined PDO attribute or a custom driver attribute
    - Returns true on success or false on failure

    We need to use this table in PHP.NET to learn/understand which attribute we can use and what are its possible values:
    https://www.php.net/manual/en/pdo.setattribute.php

    Also you can learn more about "PDO::setAttribute":
    https://docs.microsoft.com/en-us/sql/connect/php/pdo-setattribute?view=sql-server-ver15

    Example:
    In this situation we want to set the PDO error mode/act/behaviour when we have an error
    so we want PDO to stop the application execution and just throw an exception (error):

    One of the listed predefined attribute is "PDO::ATTR_ERRMODE:" for Error Reporting

    The possible values for this attribute are:
    - PDO::ERRMODE_SILENT: Just set error codes.
    - PDO::ERRMODE_WARNING: Raise E_WARNING.
    - PDO::ERRMODE_EXCEPTION: Throw exceptions.

    we will select the last one (commonly selected value) => PDO::ERRMODE_EXCEPTION

    Syntax: pdoObject->setAttribute(attributeName, value)
    */
    // this line is not mandatory to run our application but it's good for debugging :-)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Testing:
    // echo 'Database connection is done';
} catch(PDOException $e) // since using PDO, we can use "PDOException" object
// and store the error into variable named $err
{
    // Using simple echo to print output the error message and continue loading the page:
    echo "<p class='text-danger'>Database Connection Error!". $e->getMessage()."</p>";
    // Using the keyword "throw" to stop the execution of our app and display the error message
    throw new PDOException($e->getMessage());
}
