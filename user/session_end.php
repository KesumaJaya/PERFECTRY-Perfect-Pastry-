<?php

    if(empty($_SESSION['userID'])){

        die("<script>         
            alert('Session end, please login again'); 
            window.location.href='../index.html';
        </script>");
    }
?>