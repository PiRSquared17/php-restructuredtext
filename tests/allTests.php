<?php
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once(dirname(__FILE__) . '/bootstrap.php');
require_once("reporter.php");


/**
 * Agrupa todas las pruebas y las notifica.
 */
class AllTests extends TestSuite
{
    function AllTests()
    {
        # Se redefine el objeto que reporta las pruebas.
        SimpleTest :: prefer(new Reporter());

        parent::TestSuite();
        $this->addFile(dirname(__FILE__) . '/ConfigTest.php');
        $this->addFile(dirname(__FILE__) . '/ConsistenciaDBTest.php');

        // agregar aqui el resto de los tests


    }
}

?>
