<?php
if ($_GET['randomId'] != "RjSqt4fz8WKBQm_OTCjgbtAz6ArNqX9Xo2L4m3MmDwzOFesm5qqLZXlxjntwMLKo") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
