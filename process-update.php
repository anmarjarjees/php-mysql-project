<?php
    // This file for processing the update member form:

    // $title = 'Thanks for submission'; 
    // require_once 'templates/header.php'; 
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
        // Extracting the values from the $_POST array ans save each one to a varaible
        // Getting the  value of the member id from the hidden field:
        $id = $_POST['memberId'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $occupation = $_POST['occupation'];

        // Now we need to call our object "crud" and using its method updateMember() to insert the values into our database:
        // We set the method to return a boolean value:
        // - true if the update statement done!
        // - false if the update statement failed
        // so we can assign the returned value to another varaible named "isDone" for example
        // our method requires 6 arguments:
        $isDone = $crud->updateMember($id, $fname, $lname, $dob, $email, $phone, $occupation);

        if($isDone) {
            // If the update processing is done successfully
            // We can redirect the member to the member details page "show-member.php"
            // Refer to my PHP in-class code and lecture for more details to learn more about header() function
            // show-member.php => requires the member_id value to be passed through the URL 
            // We can use the same logic/code as we used before with members.php file
            /*
            So we can attach the member_id value to the link:
            1. Adding the "?" after the file name
            2. Adding any varaible name to be contain the required value that we need to pass to another page
               NOTE: in show-member.php we checking the variable "id" so we should name it "id" in this file also
            3. Assign the wanted value to that variable
            */
            header("Location:show-member.php?id=$id");
        }
        else{
            /*
            echo '<p class="text-center text-danger">Sorry we were unable to update this member record, please try again!</p>';
            */
            // We used our custom function "showMsg()" instead:
            showMsg('Sorry we were unable to register you, please try again!', 3);
        }
    } // end if from is submitted
?>

    <!-- 
        Cards:
        Bootstrap’s cards provide a flexible and extensible content container with multiple variants and options.
        Docs => Components => Card
     -->

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?php echo "$fname $lname"; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $occupation; ?></h6>
            <p class="card-text">Email Address: <?php echo $email ?></p>
            <p class="card-text">Phone: <?php echo $phone ?></p>
            <!-- 
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
            -->
        </div>
    </div>