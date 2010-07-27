<?php
require "../PHP Markdown 1.0.1n/markdown.php";
require_once(dirname(__FILE__) . '/simpletest/autorun.php');

class TestConfig extends UnitTestCase
{
    function testSintax() 
    {
        $text = Markdown("hola");
        $this->assertEqual($text, "<p>hola</p>\n");

        $text = Markdown("> quote");
        $this->assertEqual($text, "<blockquote>
  <p>quote</p>
</blockquote>
");
        
        $text = Markdown("title\n=====");
        $this->assertEqual($text, "<h1>title</h1>\n");

        $text = Markdown("  code");
        $this->assertEqual($text, "<p>code</p>\n");
    }
}
?>
