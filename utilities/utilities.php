<?php
// Finally creating a custom method to display a result text
    /*
    Our method has two parameters to accept two arguments:
    - First Argument => the text we want to display
    - Second Argument => integer value of either 1 or 0:
            1 => for using BS class "success"
            2 => for using BS class "danger"
            3 => for using BS class "warning"
    */
function showMsg($msg, $classNum=1) {
        if ($classNum==1) {
            echo '<div class="alert alert-success" role="alert">';
        } elseif ($classNum==2) {
            echo '<div class="alert alert-danger" role="alert">';
        } else {
            echo '<div class="alert alert-warning" role="alert">';
        }
            echo $msg.'</div>';
} // end function showMsg()


