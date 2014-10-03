<?php
ini_set('display_errors', 'stdout');
error_reporting(E_ALL);
require_once 'config.php';
require_once 'label_ja-JP.php';
require_once 'oauth.php';
$oauth = new oauth(CONSUMER_KEY, CONSUMER_SECRET, CALLBACK_URL);
$oauth->auth_with_code();
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css"></link>
</head>
<body>
    <div class="container" style="margin-top:20px; margin-bottom:40px;">
        <div class="alert alert-info">
            <?php echo LABEL_INSTALLATION_IS_UNDERWAY; ?>
        </div>
        <div style="text-align: right;">
            <a class="btn btn-primary" href="<?php echo $oauth->instance_url; ?>/_ui/core/chatter/ui/ChatterPage"><?php echo LABEL_GO_TO_APP; ?></a>
        </div>
    </div>
</body>
</html>
