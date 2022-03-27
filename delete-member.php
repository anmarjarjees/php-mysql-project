<!-- 
    Delete Page contains the same content as show-member.php

    We will use the id that we are getting through the URL and use it to grab the wanted record
    then view it in the form fields
-->
<?php 
$title = 'Delete Member';

/*
require => can call the file as many times as we need
require_once => can only call the file one time even if we repeat the command
*/
require_once 'templates/header.php';

// for database:
// require_once 'db_config/db_conn.php'; our old/previous code
// Now we can just reference the crud.php file and this file including the rest!
require_once 'db_config/crud.php';

$occupationsObj = $crud->getOccupations(); // This is needed for populating all the occupation titles
/*
The same logic like viewing the member details,
but this time we put the negative condition first then the main code inside the else block:
*/
if (!isset($_GET['id'])) {
    /*
    echo "<h2>Member id is not found!</h2>";
    */
    // We used our custom function "showMsg()" instead:
    showMsg('Member id is not found!', 3);
}
else {
    // Same logic as show members, getting the value of the ID for the current member
    $id = $_GET['id'];
    // saving the returned array value into a variable "memInfoArr" for "Member Information Array"
    $memInfoArr = $crud->getMemberDetails($id);

    // for testing:
    print_r($memInfoArr);
    /*
    Output:
    Array ( 
        [member_id] => 1 
        [first_name] => Alex 
        [last_name] => Chow 
        [dob] => 1975-06-21 
        [email] => alexchow@pdoprogramming.ca 
        [phone] => 1234567 
        [occupation_id] => 1 
        [name] => Information systems analysts and consultants 
    )
    */

// } // This closing brace has to be moved at the end of the form
?>
<h1>Member Information</h1>
<p>Are you sure that you want to delete the current member? You can click "Delete" to proceed or "Cancel" to cancel the operation</p>
 <form method="POST" action="process-delete.php">
    <input type="hidden" id="memberId" name="memberId" value="<?php echo $memInfoArr['member_id']; ?>">

    <div class="mb-3">
        <label for="firstname" class="form-label">First Name</label>
        <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="firstnameHelp"
        value=<?php echo $memInfoArr['first_name']; ?> readonly>
    </div>

    <div class="mb-3">
        <label for="lastname" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastnameHelp"
        value=<?php echo $memInfoArr['last_name']; ?> readonly>
    </div>

    <div class="mb-3">
        <label for="dob" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" id="dob" name="dob" aria-describedby="dobHelp"
        value=<?php echo $memInfoArr['dob']; ?> readonly>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
        value=<?php echo $memInfoArr['email']; ?> readonly>
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Phone Number:</label>
        <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp"
        value=<?php echo $memInfoArr['phone']; ?> readonly>
        <div id="phoneHelp" class="form-text">We'll never use this phone number to send you any updates.</div>
    </div>

    <?php          
        while($row = $occupationsObj->fetch(PDO::FETCH_ASSOC))  { 
            // starting our while loop block
            
            // Testing:
            // echo "<br>the value for row of 'occupation_id' key: ".$row['occupation_id'];
            // echo "<br>the occupation_id for the current member: ".$memInfoArr['occupation_id']."<hr>";

            if ($row['occupation_id']==$memInfoArr['occupation_id']) $occupation_name=$row['name'];
        }
    ?>

    <div class="mb-3">
        <label for="occupation" class="form-label">Member Occupation:</label>
        <input type="text" class="form-control" id="occupation" name="occupation" aria-describedby="occupationHelp"
        value="<?php echo $occupation_name; ?>" readonly>
        <div id="phoneHelp" class="form-text">We'll never use this phone number to send you any updates.</div>
    </div>

    <!-- 
        Using JS Code as a final reminder for the delete consequences!
        So we are giving our clients the last chance if they change their mind

        Using confirm() function:
        W3Schools: https://www.w3schools.com/jsref/met_win_confirm.asp
        MDN: https://developer.mozilla.org/en-US/docs/Web/API/Window/confirm

        NOTE: To maintain the "Progressive Enhancement" concept,
        It's better to avoid using inline JavaScript and using Event Listener instead
        Please refer to my JavaScript in-class notes and code for more clarification
    -->
    <button type="submit" class="btn btn-danger" name="submit" 
    onclick="return confirm('Are sure you want to delete this record! This process cannot be undo'); ">
        Delete
    </button>
    <!-- 
        We can add JS functionality for prompt
     -->
    <a href="members.php" class="btn btn-success">Cancel</a>
</form>
<?php
} // the closing for main/first else statement
require_once 'templates/footer.php';
?>

   