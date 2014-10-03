<?php
class SignedRequest {
    public $consumer_secret;
    public $canvas_request;

    public function __construct($consumer_secret){
        ini_set('session.use_cookies', false);
        ini_set('session.use_trans_sid', true);
        ini_set('session.use_only_cookies', false);

        // start session
    if (!session_start()){
            trigger_error("Session is not available.", E_USER_ERROR);
    }

        $this->consumer_secret = $consumer_secret;
    }

    private function extract_signed_request(){
        if (empty($_POST)){
            trigger_error("Signed Request is not set", E_USER_ERROR);
        }
        if (!array_key_exists("signed_request", $_POST)){
            trigger_error("Signed Request is not set", E_USER_ERROR);
        }

        // split signed request with "."
        $sr_r = explode('.', $_POST["signed_request"], 2);

        if (count($sr_r) != 2){
            trigger_error("Signed Request is invalid format.", E_USER_ERROR);
        }
        return($sr_r);
    }


    /*
     * function to validate signed request
     */
    public function validate_signed_request(){
        // bypass validation if canvas request has already been set to session 
        if (isset($_SESSION["canvas_request"]) && !is_null($_SESSION["canvas_request"])){
            $this->canvas_request = $_SESSION["canvas_request"];
            return true;
    }

        // recieve signed request from POST
        $sr_r = $this->extract_signed_request();

        if (empty($this->consumer_secret)){
            trigger_error("CONSUMER SECRET is not set.", E_USER_ERROR);
        }

        // calculate signed encoded context
        $calculated_value = base64_encode(hash_hmac("sha256", $sr_r[1], $this->consumer_secret, true));

        // validate signed encoded context
        if ($sr_r[0] == $calculated_value){
            $_SESSION["canvas_request"] = json_decode(base64_decode($sr_r[1]));
            $this->canvas_request = $_SESSION["canvas_request"];
            return true;
        } else {
            return false;
        }
    }

    public function get_canvas_request_in_json(){
        return json_encode($this->canvas_request);
    }
}
?>
