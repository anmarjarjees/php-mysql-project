<?php
// Our file for handling the CRUD Operations
// Using the Object Oriented Approach
class Database {
    // this will be the private variable (variable in class is called "property")
    // it will represent the $pdo object that we created in the database configuration/connection file
    private $db; // should receive the value of $pdo = new PDO($dsn, $user, $password);

    /*
    Define the special magical function for any class which is called "Constructor"
    In PHP => __construct()

    We need the constructor to set values to any private property
    when we initialize an object out of this class

    NOTE: Please refer to my OOP in PHP lectures for more clarifications if needed

    this function (method) accept the following parameter
    $connection => for database connection

    the __construct() method will be called/triggered automatically when writing new ClassName()
    myObj = new ClassName($requiredArgument)
    */
    function __construct($connection) {
        // Assigning the value of $connection to the private property $db
        // $this => this class instead of typing => Database::$db = $connection <= ANMAR Check

        // Database::$db = $connection; // Fatal error: Uncaught Error: Access to undeclared static property Database::$db
        $this->db = $connection;
    } // end __construct()

    // this class will be used to contain all the CRUD functions for our Database

    // First CRUD Function: Create (INSERT) a new record
    // We need to identify this function to be "public"
    // so we can access it with the class object in the main script in other files
    // insertMember() function should accept parameter about what to insert:
    // and we need to insert all the form fields for sure:
    public function insertMember($fname, $lname, $dob, $email, $phone, $occupation_id) {
        try {

            // Step#1: Create and define the sql statement
            // this statement contains a pure SQL statement but with placeholders instead of inserting static values directly
            // Placeholders: using PDO named parameters OR PDO anonymous parameters
            // Please refer to my lecture PDO Intro for more clarifications if needed

            /*
            Remember that our table is named "members"
            and its columns (fields) are:
            - member_id <=> No need as it's set to be auto_incremented
            - first_name
            - last_name
            - dob
            - email
            - phone
            - occupation_id

            Using the named parameter => :identifier_name
            identifier_name are just variables (placeholders) for the real values
            so they could be the same name as the table fields or similar
            in our case they have to be variable that we are passing to this function as listed in the parameters:
            1. the function parameter $fname => will have a placeholder (named parameter) :fname
            2. the function parameter $lname => will have a placeholder (named parameter) :lname
            3. the function parameter $dob => will have a placeholder (named parameter) :dob
            4. the function parameter $email => will have a placeholder (named parameter) :email
            5. the function parameter $phone => will have a placeholder (named parameter) :phone
            6. the function parameter $occupation_id => will have a placeholder (named parameter) :occupation_id
            */
            $sql =
            "INSERT INTO members (first_name, last_name, dob, email, phone, occupation_id)
            VALUES (:fname,:lname,:dob,:email,:phone,:occupation_id)";

            // Step#2: Prepare the sql statement
            /*
                PDO Prepare Statement for avoiding SQL Injection Attack

                Preparing the sql statement for:
                1. receiving the required parameters (binding the parameters)
                2. for execution the sql statements after receiving the required parameter

                The prepare syntax: pdoObject->prepare();
                calling the $this->db that refers to the PDO object to run all its methods
                prepare() method needs one parameter which is the SQL statement

                NOTE:
                We can embed the full sql statement above directly into prepare() method as an argument
                But doing the task in two steps make it easier to read/understand/debug :-)

                declaring another variable to receive the returned object of the prepare() method
                by convention, we can name it $stmt
            */
            $stmt = $this->db->prepare($sql);

            // Step#3: bind all placeholders (named parameters) to the actual values (the function arguments)
            /*
                If the prepared statement included parameter markers, either:
                - PDOStatement::bindParam() and/or PDOStatement::bindValue() has to be called
                to bind either variables or values (respectively) to the parameter markers.
                Bound variables pass their value as input and receive the output value,
                if any, of their associated parameter markers
                - or an array of input-only parameter values has to be passed

                Read more: https://www.php.net/manual/en/pdo.prepared-statements.php

                Based on the PHP.NET article we will use bindParam() method:
               - First argument: is a string for the named parameter => :identifier_name
               - Second argument: the value that we want to pass/assign to it
            */
            $stmt->bindparam(':fname', $fname);
            $stmt->bindparam(':lname', $lname);
            $stmt->bindparam(':dob', $dob);
            $stmt->bindparam(':email', $email);
            $stmt->bindparam(':phone',$phone);
            $stmt->bindparam(':occupation_id',$occupation_id);

            // Step#4: The final step is to execute statement "$stmt"
            /*
                PDOStatement::execute
                https://www.php.net/manual/en/pdostatement.execute.php

                execute() method: Returns true on success or false on failure.
            */
            $stmt->execute();
            return true; // to terminate the function after finishing the insert command successfully
            // Yes, we can just return $stmt->execute(); since execute() method returns a bool value (You can try it)
             // https://www.php.net/manual/en/pdostatement.execute.php#refsect1-pdostatement.execute-returnvalues
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false; // to terminate the function after failing to insert the data, that's why returning false
        } // end catch
    } // end method insertMember()

    // getMembers() function: Select/Read all the records from members table
    public function getMembers() {
        try {
            // $sql = "SELECT * FROM members"; // This is the old select statement to be ignored later
            /*
            NOTE:
            members table doesn't contain the Job Title NOC values, it contain only the "Foreign Keys" for these titles!
            The actual titles are saved in the parent table "occupations", so we have to join them (using inner join):
            */
            // $sql = "SELECT * FROM members INNER JOIN occupations on members.occupation_id = occupations.occupation_id";
            // Or we can give the table aliases names:
            $sql = "SELECT * FROM members AS mem INNER JOIN occupations AS occ on mem.occupation_id = occ.occupation_id";
            // calling the PDO object which is saved into the private property "db"
            // and we can access it using "$this->db"
            $result = $this->db->query($sql);
            // $result will contain all the columns from members and occupations tables
            return $result;
        }  catch (PDOException $e) {
            echo $e->getMessage();
            return false; // to terminate the function after failing to insert the data, that's why returning false
        } // end catch
    } // end method getMembers()

    // getOccupations()
    public function getOccupations() {
        try {
            // We need to retrieve:
            // - the occupation name which is "name column" to be displayed as the option labels for the users
            // - the occupation_id column to be used as the value for each corresponding occupation
            $sql = "SELECT * FROM occupations";
            // calling the PDO object which is saved into the private property "db" and we can access it using "$this->db"
            $result = $this->db->query($sql);
            return $result;
        }  catch (PDOException $e) {
            echo $e->getMessage();
            return false; // to terminate the function after failing to insert the data, that's why returning false
        } // end catch
    } // end method getOccupations()

    // this method requires the id of the member to grab its record from the database
    // the mem_id will be the same value that we can see the table column "Member ID"
    public function getMemberDetails($mem_id) {
        try {
            // We can NOT run this simple sql statement only:
            $sql = "SELECT * FROM members WHERE member_id = :id"; // This code line (sql) will be overridden below

            // we need to run the JOIN sql statement to retrieve the occupation name from the occupation table also base on the id:
            $sql =
            "SELECT * FROM members
            AS mem INNER JOIN occupations AS occ
            on mem.occupation_id = occ.occupation_id
            WHERE member_id = :id";

            $stmt = $this->db->prepare($sql);
            // Binding the required parameters/values that are needed for our SQL statement
            $stmt->bindparam(':id', $mem_id);
            // Execute the statement: using execute();
            // Remember that execute(); function return 1 (true) if the SQL statement is executed successfully
            $stmt->execute();
            // testing:
            /*
            var_dump($stmt->execute()); // bool(true)
            echo"<hr>";
            print_r($stmt->execute()); // 1bool(true)
            */

            /*
            NOTE:
            This time we need to retrieve the result set (the object) for displaying the info/result to the user
            So we can NOT return the $result variable as its value will be just boolean!

            We need to run fetch() method to fetch all the data (values) from that specific row (record)
            If we don't specify fetch() will return two arrays: associative and indexed array:

            Array (
                [member_id] => 1
                [0] => 1

                [first_name] => alex
                [1] => alex

                [last_name] => chow
                [2] => chow

                [dob] => 1975-06-21
                [3] => 1975-06-21

                [email] => alexchow@pdoprogramming.ca
                [4] => alexchow@pdoprogramming.ca

                [phone] => 1234567
                [5] => 1234567

                [occupation_id] => 1
                [6] => 1
                [7] => 1

                [name] => Information systems analysts and consultants
                [8] => Information systems analysts and consultants
            )

            Now we don't want both of them! Usually, we prefer the associative one as it's more declarative and less prone to errors
            We need to pass this argument: PDO::FETCH_ASSOC

            Please refer to:
            - My lectures "Introduction to PDO"
            - https://www.php.net/manual/en/pdostatement.fetch.php
            */
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }  catch (PDOException $e) {
            echo $e->getMessage();
            return false; // to terminate the function after failing to insert the data, that's why returning false
        } // end catch        
    } // end method getMemberDetails()

    // Adding the update record function which is similar to insert record function (method)
    // but with adding an extra parameter the "id" of the member as the first parameter (Important)
    // This id value will be used in the WHERE clause for the UPDATE statement
    public function updateMember($id, $fname, $lname, $dob, $email, $phone, $occupation_id) {
        try {
            // Step#1: Create and define the sql statement
            /*
            Remember that our table is named "members"
            and its columns (fields) are:
            - member_id <=> This value cannot be inserted/updated as it's set to be auto_incremented
            - first_name
            - last_name
            - dob
            - email
            - phone
            - occupation_id

            The Update SQL Statement Sample:
            UPDATE `members`
            SET `member_id`='[value-1]',`first_name`='[value-2]',`last_name`='[value-3]',`dob`='[value-4]',`email`='[value-5]',`phone`='[value-6]',`occupation_id`='[value-7]'
            WHERE 1
            */
            $sql =
            "UPDATE members
             SET first_name=:fname, last_name=:lname, dob=:dob, email=:email, phone=:phone, occupation_id=:occupation_id
             WHERE member_id=:id";

            // Step#2: Prepare the sql statement
            /*
                PDO Prepare Statement for avoiding SQL Injection Attack

                Preparing the sql statement for:
                1. receiving the required parameters (binding the parameters)
                2. for execution the sql statements after receiving the required parameter

                The prepare syntax: pdoObject->prepare();
                calling the $this->db that refers to the PDO object to run all its methods
                prepare() method needs one parameter which is the SQL statement

                NOTE:
                We can embed the full sql statement above directly into prepare() method as an argument
                But doing the task in two steps make it easier to read/understand/debug :-)

                declaring another variable to receive the return object of the prepare() method
                by convention, we can name it $stmt
            */
            $stmt = $this->db->prepare($sql);

            // Step#3: bind all placeholders (named parameters) to the actual values (the function arguments)
            $stmt->bindparam(':fname', $fname);
            $stmt->bindparam(':lname', $lname);
            $stmt->bindparam(':dob', $dob);
            $stmt->bindparam(':email', $email);
            $stmt->bindparam(':phone',$phone);
            $stmt->bindparam(':occupation_id',$occupation_id);
            // don't forget to bind the id value:
            $stmt->bindparam(':id', $id);

            // Step#4: The final step is to execute statement "$stmt"
            $stmt->execute();
            return true; // to terminate the function after finishing the insert command successfully
            // Yes, we can just return $stmt->execute(); since execute() method returns a bool value (Try it Anmar)
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false; // to terminate the function after failing to insert the data, that's why returning false
        } // end catch
    } // end method updateMember()

    public function deleteMember($id) {
        try {
            $sql = "DELETE FROM members WHERE member_id=:id";
            // Step#1: prepare the SQL Statement
            $stmt = $this->db->prepare($sql);
            // Step#2:
            // bind placeholder (named parameters) which is :id
            // to the actual values (the function arguments) which is $id
            $stmt->bindparam(':id', $id);
            // Step#3: The final step is to execute statement "$stmt"
            $stmt->execute();
            return true;
        }  catch (PDOException $e) {
            echo $e->getMessage();
            return false; // to terminate the function after failing to insert the data, that's why returning false
        } // end catch
    } // end method deleteMember()
} // end class Database
