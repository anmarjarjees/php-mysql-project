<?php 
$title = 'Workshop Members';
require_once 'templates/header.php';
// for database:
require_once 'db_config/crud.php';

$membersInfoObj = $crud->getMembers();

// test:
var_dump($membersInfoObj); // object(PDOStatement)#3 (1) { ["queryString"]=> string(21) "SELECT * FROM members" }
echo"<hr>";
print_r($membersInfoObj); // PDOStatement Object ( [queryString] => SELECT * FROM members )
?>
<!-- page content: -->
<h1>Web Development Workshop Members</h1>
<!-- 
    Using BS5 Tables: https://getbootstrap.com/docs/5.1/content/tables/

    NOTE: 
    The table columns are too many to be displayed and fit in one row, especially because of their long data
    So we can customize the table to view only the most important info 
    and just leave the details to be displayed in different page for every individual member that we select
 -->
 <table class="table">
  <thead>
    <tr>
      <th scope="col">Member ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <!-- 
        We can hide these personal contact info from being displayed Date Of Birth, Email, and Phone:
        - To save some space and make the rest of the column fit in the browser nicely
        - Maybe to add some privacy! So we can view only this page to our audience for example 
        to introduce them to each other by their full name and occupation only, just an idea :-)
      -->
      <!-- 
      <th scope="col">Date Of Birth</th> 
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      -->
      <th scope="col">Occupation</th>
      <th>To Do</th>
    </tr>
  </thead>

  <tbody>
    <!-- 
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr> 
    
    Insert PHP block for using while loop to go through all the records:
    -->
    <?php
        // Using while loop:
        // Please refer to my lectures "PDO Introduction" for more clarifications if needed
        /*
            We will do this operation: $results->fetch(PDO::FETCH_ASSOC)
            for each/every row in our table and format the returned value as an associative array
        */
        while($row = $membersInfoObj->fetch(PDO::FETCH_ASSOC))  { // starting our while loop block
    ?>
    <!-- inside the while block, we are generating a table row with table data -->
    <tr>
        <td><?php echo $row['member_id'] ?></td>
        <td><?php echo $row['first_name'] ?></td>
        <td><?php echo $row['last_name'] ?></td>
        <!-- Hiding these cells based on what we have as the column titles above -->
        <!-- 
        <td><?php echo $row['dob'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['phone'] ?></td> 
        -->
        <!-- <td>< ? php echo $row['occupation_id'] ?></td> -->
        <td><?php echo $row['name'] ?></td>
        <!-- 
          Attaching BS classes to create button!
          The .btn classes are designed to be used with the <button> element. 
          you can also use these classes on <a> or <input> elements.

          Example: <a class="btn btn-primary" href="#" role="button">Link</a>

          https://getbootstrap.com/docs/5.1/components/buttons/#button-tags

          PHP NOTE:
          Problem:
          We need to pass the value of "Member ID" of the current clicked member which is save into: $row['member_id']

          Solutions:
          We can have two solutions for this problem:
            Solution#1:
            =========== 
            Using the normal way by saving this specific value of this record which is $row['member_id']
            to our Super Global Array $_SESSION by defining/adding a specific key:
            $_SESSION['memberId'] = $row['member_id']
            Then when the "member_details.php" is loaded we can get the member id though the $_SESSION array

            in such case, we don't need to modify the link, we can keep as simple as such:
            <a href="member-details.php" class="btn btn-primary">View</a>  

            Solution#2: (Easier)
            ===========
            Passing the value of the member id through the URL!
            So we can attach the member_id value to the link:
            1. Adding the "?" after the file name
            2. Adding any varaible name to be contain the required value that we need to pass to another page
            3. Assign the wanted value to that variable

            We can do it in two ways:

            First Way:
            We can use a built-in PHP function called "urlencode" 
            
            Description: urlencode(string $string): string
            This function returns a string in which all non-alphanumeric characters 
            except -_. have been replaced with a percent (%) sign 
            followed by two hex digits and spaces encoded as plus (+) signs.

            In the example below from PHP.NET:     
            You can see that the function is used to filter the user input directly: 
            echo '<a href="mycgi?foo=', urlencode($userinput), '">';

            You can read more: https://www.php.net/manual/en/function.urlencode.php

            In our case, we can use this function to encode the member id as shown blow:
            href="member-details.php?id=<?php echo urlencode($row['member_id']); ?>"

            Second Way:
            Since the member id value are getting from the primary key field in our table in the database,
            we can just do the assignment without calling this function (no need) as shown below:
            href="member-details.php?id=<?php echo $row['member_id']; ?>

            Both ways work fine :-)

            We named the varaible to be "id"
         -->
        <td>
          <!-- First <a> for viewing/selecting record -->
          <a href="show-member.php?id=<?php echo $row['member_id']; ?>" class="btn btn-primary">View Details</a>
          <!-- Second <a> for Updating record -->
          <a href="update-member.php?id=<?php echo $row['member_id']; ?>" class="btn btn-warning">Update</a>
           <!-- Third <a> for Deleting record -->
           <a href="delete-member.php?id=<?php echo $row['member_id']; ?>" class="btn btn-danger">Delete</a>
        </td>
    </tr> 

    <?php
        } // closing the while loop block
    ?>
  </tbody>
</table>

<?php
require_once 'templates/footer.php';
?>

   