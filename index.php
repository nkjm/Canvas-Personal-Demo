<?php
ini_set('display_errors', 'stdout');
error_reporting(E_ALL);
require_once 'config.php';
require_once 'label_ja-JP.php';
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css"></link>
</head>
<body>
    <div class="container">
        <div class="alert alert-info">
            <?php echo LABEL_SUCCESSFULLY_INSTALLED; ?>
        </div>
    </div>
</body>
</html>
