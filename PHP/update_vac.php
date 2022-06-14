<?php

require 'connect.php';

$fname = $_POST['fname']; //Variables POST from form
$sname = $_POST['sname'];
$add1 = $_POST['add1'];
$add2 = $_POST['add2'];
$pc = $_POST['pc'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$true = 'true';
$false = 'false';




//search the table for a matching entry
//if entry exists (because customer has already used the order-test form), update is_callback = true
//else create entry, with update is_callback = true


//Check for matching record
$query="SELECT * FROM visitor_info WHERE fname = '" . $fname . "' AND sname = '" . $sname . "' AND add1 = '" . $add1 . "' AND add2 = '" . $add2 . "' AND pc = '" . $pc . "' AND phone = '" . $phone . "' AND email = '" . $email . "'";
$result = $conn->query($query);
if (!$result) die($conn->error);
$num = $result->num_rows;

echo $num;



//if match (from vaccine form), update is_callback to true)
if ($num == 1) {
    $update_rec = "UPDATE visitor_info SET is_callback = 'true' WHERE fname = '" . $fname . "' AND sname = '" . $sname . "' AND add1 = '" . $add1 . "' AND add2 = '" . $add2 . "' AND pc = '" . $pc . "' AND phone = '" . $phone . "' AND email = '" . $email . "'";
    $conn -> query($update_rec);
if (!$update_rec) die($conn->error);
    $conn -> query('COMMIT');

echo 'updated';
}

//else, create new  entry in table, with is_callback = true

else {

    $add_rec = "INSERT INTO visitor_info VALUES ('" . $fname . "', '" . $sname . "', '" . $add1 . "', '" . $add2 . "', '" . $pc . "', '" . $phone . "', '" . $email . "', '" . $false . "', '" . $true . "')";
    $conn -> query($add_rec);
    if (!$add_rec) die($conn->error);
    $conn -> query('COMMIT');
    
    echo 'added';
}

$result->close();
$conn->close();


header("Location: http://localhost/html/confirm_vac.html"); //redirect to confirmation page


?>
