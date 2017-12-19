<?php

class Login {

    public function __construct($user, $pass) {
        $this->loginViaXml($user, $pass);
    }

    public function loginViaXml($user, $pass) {
        if (
            (!strpos($user, '<') || !strpos($user, '>')) &&
            (!strpos($pass, '<') || !strpos($pass, '>'))
        ) {
            $format = '<?xml version="1.0"?> <user v="%s"/> <pass v="%s"/>';
            $xml = sprintf($format, $user, $pass);
            $xmlElement = new SimpleXMLElement($xml);

            // Perform the actual login.
            $this->login($xmlElement);
        }
    }
}

if (isset($_POST['username'], $_POST['password'])) {
    new Login($_POST['username'], $_POST['password']);
}

?>
<!DOCTYPE html>


<html>
    <head lang="en">
        <meta charset="utf-8">
        <title>Day #4</title>
        <style>
            .login-form {
                display: flex;
                justify-content: center;

                background-color: lightgrey;
                margin: 25px auto;
                max-width: 500px;
                padding: 20px;
            }
        </style>
    </head>

    <body>

        <div class="login-form">

            <form action="<?= $_SERVER['PHP_SELF']?>" method="POST">
                <h3>Enter your credentials to login:</h3>
                <label>
                    Username:
                    <input type="text" name="username">
                </label><br><br>
                <label>
                    Password:
                    <input type="password" name="password">
                </label><br><br>
                <input type="submit" value="Login">
            </form>
        </div>
    </body>
</html>
