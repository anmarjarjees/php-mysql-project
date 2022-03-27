<?php
$title = 'Member Details';
require_once 'templates/header.php';

// for database:
require_once 'db_config/crud.php';

/*
    Since the id value are being passed through the URL:
    - we need to use the supper global $_GET array to get the value from the URL and use it in this page
    (for more info refer to my lectures about using the Super Global Varaibles)
    - It's better to double check if the value does exist using isset() function first, then we can proceed with calling our function
*/
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $memberDetailsArray = $crud->getMemberDetails($id);

    // Testing:
    /*
    var_dump($memberDetailsArray); 
    echo"<hr>";
    print_r($memberDetailsArray); 
    */

    /*
    Output:
    Array ( 
        [member_id] => 1
        [first_name] => alex 
        [last_name] => chow 
        [dob] => 1975-06-21 
        [email] => alexchow@pdoprogramming.ca 
        [phone] => 1234567 
        [occupation_id] => 1 
    )
    */
?>  
   
    <!-- page content: -->
    <h1>Member Details</h1>
    <!-- 
        Cards:
        Bootstrap’s cards provide a flexible and extensible content container with multiple variants and options.
        Docs => Components => Card

        was => style="width: 18rem;"
        I changed it to => style="width: 30rem;"
    -->

    <div class="card" style="width: 30rem;">
        <div class="card-body">
            <h5 class="card-title">
                <?php 
                echo "ID: ".$memberDetailsArray['member_id'].". ".$memberDetailsArray['first_name']." ".$memberDetailsArray['last_name']; 
                ?>
            </h5>

            <h6 class="card-subtitle mb-2 text-muted">
                <?php echo $memberDetailsArray['name']; ?>
            </h6>

            <p class="card-text">
                Email Address: <?php echo $memberDetailsArray['email']; ?>
            </p>

            <p class="card-text">
                Phone: <?php echo $memberDetailsArray['phone']; ?>
            </p>

            <p class="card-text">
                Date of Birth: <?php echo $memberDetailsArray['dob'];  ?>
            </p>
            <!-- 
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
            -->
        </div>
        <!-- 
            Adding our links the same from the members page: 
            Same code just by changing $row to $memberDetailsArray based on our current array name
            Plus modify the first link to return to the members page beside the link in the main nav, more convenient
        -->
        <div>
            <!-- First <a> for viewing all members -->
            <a href="members.php" class="btn btn-info">View All Members</a>
            <!-- Second <a> for Updating record -->
            <a href="update-member.php?id=<?php echo $memberDetailsArray['member_id']; ?>" class="btn btn-warning">Update</a>
            <!-- Third <a> for Deleting record -->
            <a href="delete-member.php?id=<?php echo $memberDetailsArray['member_id']; ?>" class="btn btn-danger">Delete</a>          
        </div>
    </div>  
<?php
} 
else {
    echo "<h2>Member id is not found!</h2>";
}
?>

<!-- 
    Important Note:
    ***************
    We can reverse the logic above to make the mixing between HTML and PHP element a little bit less and clearer 
    by using or starting with the negative first:

    if (!isset($_GET['id'])) {
        Display an error/warning message => echo "<h2>Member id is not found!</h2>";
    } else {
        Place your entire code to render the member details in the else block      
    }

    But just for learning domenstation of nesting php elements with html code, I used the longer one :-)
    Please feel free to use any logic in your assignment

    ===============================================================================================================

    Finally, to check the error message you can remove the id value from the url:
    http://localhost/php-mysql-project/member-details.php

 -->

<?php
require_once 'templates/footer.php';
?>

