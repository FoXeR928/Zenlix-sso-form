<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание заявки</title>
</head>
<body>
    <H1>Пожалуйста ожидайте создание заявки</H1>
</body>
<?php
    //подключение файла конфигов
    require('../config/config.php');
    //подключение файла работы с бд
    require('../db/db_connect.php');
    //подключение файла запроса к бд
    require('../db/sql_query.php');

    //получение времени и переменных post
    $add_time= date('Y-m-d H:i:s', time());
    $name=$_POST["user"];
    $subj=$_POST["subj"];
    $msg=$_POST["msg"];
    $ip = $_POST["ip"];

    //получение id пользователя
    $user_id=query_sql_array(sprintf($query['get_user_id'],$name))['id'];
    //проверка в какой отдел направлено
    if(strpos($subj, '1C') !== false){
        $to=$mail_list['1c_dep'];
        $mail_to=$mail_list['1c_mails'];
    }else{
        $to=$mail_list['it_dep'];
        $mail_to=$mail_list['it_mails'];
    }
    //запросы в бд на создание заявки
    $add_ticket=query_sql_create(sprintf($query['add_ticket'],$user_id,$add_time,$subj,$msg,$user_id,$to,$add_time));
    $ticket_id=query_sql_array(sprintf($query['ticket_id'],$user_id))['id'];
    $add_hash=query_sql_create(sprintf($query['add_hash'],$ticket_id,$ticket_id));
    $add_ticket_info=query_sql_create(sprintf($query['add_ticket_info'],$ticket_id,$ip));
    $add_ticket_log=query_sql_create(sprintf($query['add_ticket_log'],$add_time,$user_id,$ticket_id));

    //отправка заявки на почту
    mail($mail_to,$mail_header['mail_new_ticket'],sprintf($mail_text['mail_ticket'],$name,$subj,$msg,$ticket_id,$ip), $mail_header['mail_from']);
    //возвращение на страницу формы
    header('Location: '. $host['host'] .'index.php');
    exit;
?>
</html>
