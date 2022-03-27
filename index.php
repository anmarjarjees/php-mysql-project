<!-- 
    Index Page is always the first file for any website 
    Any webserver (including our localhost) is looking for this type of files to be run first (index.html or index.php)
-->
<?php 
/*
Setting a unique title for each page: 
Notice that we need to declare the varaible "title" before using require_once for header.php
as this variable need to be identified before being used/called in the header.php
*/
$title = 'Welcome to My PHP App.';

/*
require => can call the file as many times as we need
require_once => can only call the file one time even if we repeat the command
*/
require_once 'templates/header.php';

// for database:
// require_once 'db_config/db_conn.php'; our old/previous code
// Now we can just reference the crud.php file and this file including the rest!
require_once 'db_config/crud.php';

$occupationsObj = $crud->getOccupations();

?>
<h1>PHP and MySQL Development Workshop</h1>
<p>You can registerer for free to attend our 3 days workshop about PHP web development
    with Databases using the PHP database Object (PDO). 
    The workshop will run from Monday to Wednesday from (9:30 AM to 4:30 PM).
</p>

<!-- 
    Designing a form: Docs => Forms
    https://getbootstrap.com/docs/5.1/forms/overview/

    Copying the basic template and modify it

    We will customize the BS5 form fields:
        - First Name:
        - Last Name:
        - Date of Birth (Using DatePicker):
        - Email Address:
        - Phone Number
        - Occupation/Job Title: (Web Developer)

        National Occupational Classification (NOC) in Canada:
        2171 – Information systems analysts and consultants	
        2172 – Database analysts and data administrators	
        2173 – Software engineers and designers	
        2174 – Computer programmers and interactive media developers	
        2175 – Web designers and developers
        4021 - College and other vocational instructor
        Other

        You can read more: https://www.statcan.gc.ca/eng/concepts/consult-noc/noc-correspondence-prelim#wb-auto-2
        ---------------------------------------------------------------------------------------------------------

        For the "form" element to work, we need two attributes:
            - method
            - action

        Also adding name attribute for each form control/field

        Please refer to my in-class notes and code to review these information (if needed)
 -->
 <form method="POST" action="process-insert.php">
    <div class="mb-3">
        <label for="firstname" class="form-label">First Name</label>
        <!-- 
            Associating form text with form controls
            Form text should be explicitly associated with the form control it relates to using the aria-describedby attribute. 
            This will ensure that assistive technologies—such as screen readers—will announce this form text when the user focuses or enters the control.
         -->
        <input type="text" required class="form-control" id="firstname" name="firstname" aria-describedby="firstnameHelp">
    </div>

    <div class="mb-3">
        <label for="lastname" class="form-label">Last Name</label>
        <input type="text" required class="form-control" id="lastname" name="lastname" aria-describedby="lastnameHelp">
    </div>

    <div class="mb-3">
        <label for="dob" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" id="dob" name="dob" aria-describedby="dobHelp">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" required class="form-control" id="email" name="email" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Phone Number:</label>
        <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp">
        <div id="phoneHelp" class="form-text">We'll never use this phone number to send you any updates.</div>
    </div>

    <!-- 
        Docs => Forms => Select
        https://getbootstrap.com/docs/5.1/forms/select/
     -->
     <div class="mb-3">
        <label for="occupation" class="form-label">Select NOC title(s) that relevant to your Occupation/Job Title (You can select more than one):</label>
        <select class="form-select" id="occupation" name="occupation" multiple aria-label="multiple select example">
            <!-- 
                Remember that we need to receive these values from our database
                the NOC titles are stored in "occupations" table

                Instead of hard coding the values of option elements we can get them from our table!
             -->
            <!-- <option value="1">2171 – Information systems analysts and consultants</option>
            <option value="2">2172 – Database analysts and data administrators</option>	
            <option value="3">2173 – Software engineers and designers</option>	
            <option value="4">2174 – Computer programmers and interactive media developers</option>	
            <option value="5">2175 – Web designers and developers</option>
            <option value="6">4021 - College and other vocational instructors</option> -->

            <?php  
                while($row = $occupationsObj->fetch(PDO::FETCH_ASSOC))  { // starting our while loop block
            ?>
                <option value="<?php echo $row['occupation_id']; ?>"
                    <?php if ($row['occupation_id']==1) {
                                        echo 'selected';
                                    } 
                    ?>>
                    <?php echo $row['name']; ?>
                </option>            
            <?php
                } // closing the while loop block
            ?>
        </select>
    </div>

    <!-- <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div> -->

    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>

<?php
require_once 'templates/footer.php';
?>

   