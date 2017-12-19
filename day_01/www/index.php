<?php

class Challenge {

    const UPLOAD_DIRECTORY = './upload_dir/';

    private $file;
    private $whitelist;

    public function __construct($file) {
        $this->file = $file;
        $this->whitelist = range(1, 24);
    }

    public function __destruct() {
        if (in_array($this->file['name'], $this->whitelist)) {
            move_uploaded_file(
                $this->file['tmp_name'],
                self::UPLOAD_DIRECTORY . $this->file['name']
            );
        }
    }
}

if (isset($_FILES['solution'])) {
    $challenge = new Challenge($_FILES['solution']);
}

?>
<!DOCTYPE html>


<html>
    <head lang="en">
        <meta charset="utf-8">
        <title>Day #1</title>
    </head>

    <body>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="30000">

            <label for="solution">Choose a file to upload: </label>
            <input name="solution" type="file">

            <br><br>

            <label for="submit">Submit: </label>
            <input id="submit" type="submit" value="Send File">
        </form>

    </body>
</html>
