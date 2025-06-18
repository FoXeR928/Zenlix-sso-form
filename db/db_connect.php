<?php
    //функция подключения к бд
    function connect_db(){
        //запрос файла конфигов
        require('../config/config.php');
        $connect=mysqli_connect($db_config['host'],$db_config['user'],$db_config['password'],$db_config['db_name']);
        mysqli_set_charset($connect, $db_config['db_cod']); 
        if (!$connect){
            echo mysqli_connect_error();
        }
        else{
            return $connect;
        }
    }
    //функция запроса на строчку
    function query_sql_array($query){
        $connect=connect_db();
        $query_send=mysqli_query($connect,$query);
        $result=mysqli_fetch_array($query_send);
        return $result;
        mysqli_close($connect);
    }
    //функция запроса на несколько строчек строчку
    function query_sql_assoc($query){
        $connect=connect_db();
        $query_send=mysqli_query($connect,$query);
        return $query_send;
        mysqli_close($connect);
    }
    //функция запроса на создание и добавление
    function query_sql_create($query){
        $connect=connect_db();
        $query_send=mysqli_query($connect,$query);
        mysqli_close($connect);
    }
?>