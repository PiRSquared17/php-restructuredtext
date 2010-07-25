<html>
    <head>
        <style>
        pre {float: left; border: 1px solid gray; padding: 1em; margin-right: 3em;}
        hr {clear: both;}
        </style>
    </head>
<body>

<?php
require "rst.php";

ini_set('display_errors', 'on');
error_reporting(E_ERROR);


/* Para convertir el texto original en HTML tiene
 * que utilizar la clase RST. */
echo "<pre>Original text</pre> \n";
echo RST("Converted text");
echo "<hr/>";


/* Ahora se toman varios textos de ejemplo de
 * una colección y se imprimen en crudo y convertidos
 * a HTML para observar la conversión.
 */


$text_collection = array(
"Hola",
"Titulo de nivel 1
-----------------
",
"codigo preformateado::
    
    #include <stdio.h>
    int main(void)
    {
        [..]
        return 1;
    }
",
"Texto con atributos: *italic* or **bold**.",
"- uno
- dos
- tres",
"
- uno
    - dos
  - asd
 - tres
- ejemplo",
"imagenes:

.. image:: image_test.png
"
);


foreach ($text_collection as $text)
{
    echo "<pre>$text</pre> \n";
    echo RST($text);
    echo "<hr/>";
}

$original_text = "
Bienvenido
----------
";

echo "<PRE>$original_text</PRE>";
$text = RST($original_text);
echo $text;

/*
============
super titulo
============


titulo
======

otro
----

- item 1
- item 2

.. image:: algo.png

![adads](hola.png)

.. code-block:: python

    import os
    os.path.join('a', 'b')


otro ejemplo::

    mas texto



");

echo $text;

 */
?>


</body></html>
