<?php
require "../PHP Markdown 1.0.1n/markdown.php";

$text = 
"texto

Hola
====

hola *mundo*

> hola
> otro

    source_code.php

mas";

$parser = Markdown($text);
echo $parser;

?>
