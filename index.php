<?php
ini_set('display_errors', 'stdout');
error_reporting(E_ALL);
require_once 'config.php';
require_once 'label_ja-JP.php';
require_once "SignedRequest.php";
$sr = new SignedRequest(CONSUMER_SECRET);

/* 
Call validate_signed_request method to validate recieved Signed Request. 
True will be returned if validation succeeds. 
False will be returned if validation fails. 
At the same time, this will set $sr->canvas_request on validation sccessful.
*/
if ($sr->validate_signed_request()){
    $sr_validation_result = 'success';
} else {
    $sr_validation_result = 'error';
}
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css"></link>
</head>
<body>
    <div class="container">
        <div class="alert alert-<?php echo $sr_validation_result; ?>">
            <?php
            if ($sr_validation_result == 'success'){
                echo LABEL_SUCCESSFULLY_INSTALLED;
            } else {
                echo SIGNED_REQUEST_VALIDATION_FAILED;
            }
            ?>
        </div>
    </div>
</body>
</html>
