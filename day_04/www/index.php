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

            // stub for a "credentials" XML document
            $format = '<?xml version="1.0"?>
                       <credentials><user>%s</user><pass>%s</pass></credentials>';

            $xml = sprintf($format, $user, $pass);
            $credentials = new SimpleXMLElement($xml);

            // perform the actual login
            $this->doLogin($credentials);
        }
    }

    // Note: this is just a stub method... the login process is not relevant
    // for this example... this just shows you how this page "sees" the input
    public function doLogin(SimpleXMLElement $credentials) {
        echo '<pre>';
        echo htmlspecialchars($credentials->asXML());
        echo '</pre>';
    }
}

if (isset($_POST['username'], $_POST['password'])) {
    new Login($_POST['username'], $_POST['password']);
    exit;
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
