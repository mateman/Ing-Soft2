<?php 

function ObtenerIP()
{
    $ip = "";
    if(isset($_SERVER))
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
    }
    else
    {
        if ( getenv( 'HTTP_CLIENT_IP' ) )
        {
            $ip = getenv( 'HTTP_CLIENT_IP' );
        }
        elseif( getenv( 'HTTP_X_FORWARDED_FOR' ) )
        {
            $ip = getenv( 'HTTP_X_FORWARDED_FOR' );
        }
        else
        {
            $ip = getenv( 'REMOTE_ADDR' );
        }
    }
    // En algunos casos muy raros la ip es devuelta repetida dos veces separada por coma
    if(strstr($ip,','))
    {
        $ip = array_shift(explode(',',$ip));
    }
    return $ip;
}

    define('DB_HOST','localhost');
    define('DB_USUARIO','root');
    define('DB_PASSWORD','');
    define('DB_NOMBRE','ingenieria3');
    define('RUTA_APP', dirname(dirname(__FILE__)));
    define('RUTA_URL', 'http://'.ObtenerIP().'/Ing-Soft2');
    define('NOMBRE_SITIO',' _NOMBRE_SITIO');
