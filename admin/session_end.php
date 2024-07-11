<?php

    if(empty($_SESSION['adminID'])){

        die("<script>         
            alert('Session end, please login again'); 
            window.location.href='../index.html';
        </script>");
    }
?>