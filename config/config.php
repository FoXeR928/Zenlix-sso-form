<?php
    //конфиг базы данных
    $host=array(
        'host'=>'http://zenlix_url',
        'refresh'=>60
    );
    $db_config=array(
        'host'=>'localhost',
        'user'=>'',
        'password'=>'',
        'db_name'=>'zenlix',
        'db_cod'=>"utf8"
    );
    //адреса для заявок
    $mail_list=array(
        '1c_dep'=>7,
        '1c_mails'=>"",
        'it_dep'=>6,
        'it_mails'=>"",
        'it_admin'=>""
    );
    //текст темы письма
    $mail_header=array(
        'mail_new_ticket'=>'Новая заявка',
        'mail_new_user'=>"Нет пользователя",
        'mail_from'=>'From: Техподдержка',
    );
    //текст письма
    $mail_text=array(
        'mail_ticket'=>"От: %s

Тема: %s
    
Описание:
%s
    
Заявка: ". $host['host'] ."/ticket?%u
    
IP: %s",
        'mail_no_user'=>"Нету пользователя %s в базе"
    );
?>