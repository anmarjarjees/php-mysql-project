<?php
    // This file for processing the delete member form:

    require_once 'db_config/crud.php';

    /*
    Very Important Note:
    --------------------
    As we have learnt before (Refer to my in-class notes for more details)
    Updating or deleting  a record from database are very danger commands for two reasons:
        - There is no Undo for this process
        - If don't specify which record we wan to update/delete, MySQL will update all the records
    
    So we should add the WHERE clause to filter/select only the required record
    As usual, we can target the wanted record by its primary key value 
    Normally, the primary key value is the id column
    */

    // Check if the form is submitted
    // we can just check if submit has a value (which means it was clicked) 
    if(isset($_POST['submit'])){
        // Extracting the only the ID value from the $_POST array ans save each one to a varaible
        // Getting the  value of the member id from the hidden field:
        $id = $_POST['memberId'];

        // Now we need to call our object "crud" and using its method updateMember() to insert the values into our database:
        // We set the method to return a boolean value:
        // - true if the update statement done!
        // - false if the update statement failed
        // so we can assign the returned value to another varaible named "isDone" for example
        // our method requires 6 arguments:
        $isDone = $crud->deleteMember($id);

        if($isDone) {
            // If the delete processing is done successfully
            // We can redirect the member to the all members page "members.php"
            // Refer to my PHP in-class code and lecture for more details to learn more about header() function
            header("Location:members.php");
        }
        else {
            /*
            echo '<p class="text-center text-danger">Sorry we were unable to delete this member record, please try again!</p>';
            */
            // We used our custom function "showMsg()" instead:
            showMsg('Sorry we were unable to delete this member record, please try again!', 3);
        }
    } // end if from is submitted
?>