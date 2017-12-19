<?php

// composer require "twig/twig"
require __DIR__ . '/../vendor/autoload.php';

class Template {

    private $twig;

    public function __construct() {
        $indexTemplate = '<img ' .
            'src="https://loremflickr.com/320/240">' .
            '<a href="{{link|escape}}">Next slide &gt;&gt;</a>';

        // Default twig setup; simulate loading index.html file from disk
        $loader = new Twig\Loader\ArrayLoader([
            'index.html' => $indexTemplate
        ]);
        $this->twig = new Twig\Environment($loader);
    }

    public function getNexSlideUrl() {
        $nextSlide = $_GET['nextSlide'];
        return filter_var($nextSlide, FILTER_VALIDATE_URL);
    }

    public function render() {
        echo $this->twig->render(
            'index.html',
            ['link' => $this->getNexSlideUrl()]
        );
    }
}

?>
<!DOCTYPE html>


<html>
    <head lang="en">
        <meta charset="utf-8">
        <title>Day #2</title>
    </head>

    <body>
        <?php (new Template())->render(); ?>
    </body>
</html>
