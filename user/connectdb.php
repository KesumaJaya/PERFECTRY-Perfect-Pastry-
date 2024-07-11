<?php    
    try {
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'perfectry';
        $link = mysqli_connect($host, $username, $password, $dbname);

    } catch (mysqli_sql_exception) {
        echo "Server Down !!";
    }
?>