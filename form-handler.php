<?php 
$submit = isset($_POST["submit"]) ? $_POST["submit"] : false;
if($submit == "Pošalji"){
    $to = "xxx@gmail.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $subject = $_POST['title'];
    $subject2 = "Copy of your form submission";
    $message = $first_name . " " . $last_name . " napisao je sljedeće:" . "\n\n" . $_POST['message'];
    $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];
    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    echo "Poruka poslana. Hvala " . $first_name . " na poruci.";
    header("Location:index.php");
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    // You cannot use header and echo together. It's one or the other.
    }else {
        header("Location:index.php");
    }
?>