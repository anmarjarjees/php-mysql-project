<?php
    // This file for processing the registration form:

    $title = 'Thanks for submission';
    require_once 'templates/header.php';
    require_once 'db_config/crud.php';

    // Check if the form is submitted
    // we can just check if submit has a value (which means it was clicked)
    if(isset($_POST['submit'])){
        // Extracting the values from the $_POST array ans save each one to a varaible
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $occupation = $_POST['occupation'];

        // Now we need to call our object "crud"
        // and using its method insertMember() to insert the values into our database:
        // We set the method to return a boolean value:
        // - true if the insert statement done!
        // - false if the insert statement failed
        // so we can assign the returned value to another varaible named "isDone" for example
        // our method requires 5 arguments:
        $isDone = $crud->insertMember($fname, $lname, $dob, $email, $phone, $occupation);

        if($isDone){
            /*
            echo '<p class="text-center text-success">Thank you for registering in our Web Development Workshop!</p>';
            */

            // We used our custom function "showMsg()" instead:
            showMsg('Thank you for registering in our Web Development Workshop!', 1);

        }
        else{
            /*
            echo '<p class="text-center text-danger">Sorry we were unable to register you, please try again!</p>';
            */

            // We used our custom function "showMsg()" instead:
            showMsg('Sorry we were unable to register you, please try again!', 2);
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
