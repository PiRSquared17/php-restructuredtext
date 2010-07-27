<?php
require_once('bootstrap.php');
require_once('install/install_utils.php');
//require_once('config.php');

class TestConfig extends UnitTestCase
{

    function is_writable($file)
    {
        return make_writable(dirname(__FILE__) . "/".$file);
    }

    function testFilePermisions() 
    {
        $files = array();
        $files[] = '../../cache/';
        $files[] = '../../modules/';
        $files[] = '../../custom/';

        foreach ($files as $file)
        {
            $this->assertTrue($this->is_writable($file), "Permisos de escritura en $file.");
        }
    }


    function testPHP()
    {
        $memory_limit = ini_get('memory_limit');

        $memory_limit_value = explode('M', $memory_limit);
        $memory_limit_value = $memory_limit_value[0] + 0;

        $this->assertTrue($memory_limit_value >= 256, "Memoria para PHP superior a 256M");
    }

    function testConfig()
    {
        global $sugar_config;

        #echo $sugar_config['site_url']."\n";
    }


    
  function testFormatoFecha() 
  {

    global $sugar_config;

    $this->assertTrue( $sugar_config['datef']  == 'd/m/Y', "datef config.php" );

    $this->assertTrue( $sugar_config['default_time_format'] == 'H:i', "default_time_format en config.php" ); 

  }



  function testConfigUsuarios()
  {

    global $db;
    $userPreference = new UserPreference();

    $sql = "select id from users ";
                
    $queryresult = $db->query( $sql, $dieOnError = true );

    $this->assertTrue( $queryresult, "Configuracion Usuarios - query" );

    $ok_fecha = true;
    $ok_time = true;
    
    while ( $row = $db->fetchByAssoc($queryresult) ) {

      $user = new User();
      $user->retrieve( $row['id'] );
      
      $dateformat = $userPreference->getUserDateTimePreferences( $user );

      if ( empty($dateformat )  ||  $dateformat['date'] != 'd/m/Y' )  {
	$ok_fecha = false;
	$usuarioinfractor = $row['id'];
	break;
      }

      if ( $dateformat['time'] != 'H:i'  ) {
	$ok_time = false;
	$usuarioinfractor = $row['id'];
	break;
      }

    }

    $this->assertTrue( $ok_fecha, "FECHA formato. usuario = " . $row['id']   );
    $this->assertTrue( $ok_time, "TIME. formato usuario = " . $row['id']   );
    

  }




    function testDataBase()
    {
        global $sugar_config;

        $db_host_name = $sugar_config['dbconfig']['db_host_name'];
        $db_username = $sugar_config['dbconfig']['db_user_name'];
        $db_password = base64_decode($sugar_config['dbconfig']['db_user_name']);
        $db_name = $sugar_config['dbconfig']['db_user_name'];


        $link = mysql_connect($db_host_name, $db_username, $db_password);
        $this->assertTrue($link, "Probando conexion");

        $exist = mysql_select_db($db_name, $link);

        $this->assertTrue($exist, "Selecciona $db_name");


        mysql_close($link);

    }

  function testAltaFormulario()
  {
      $id_formulario = '11111111-c0c1-d348-ac05-47aa30098f82';
      $user = new User();
      $user->retrieve($id_formulario);

      $this->assertTrue($user->user_name, "formulario", "no existe el usuario formulario.");
  }
    


}
?>
