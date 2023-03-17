<?php
    $add_time= date('Y-m-d H:i:s', time());
    $name=$_SERVER['PHP_AUTH_USER'];
    $subj=$_POST["subj"];
    $msg=$_POST["msg"];
    $ip = @$_SERVER['REMOTE_ADDR'];

    $connect=mysqli_connect('localhost', 'mysql_user', 'mysql_pass', 'zenlix_table');
    mysqli_set_charset($connect, "utf8"); 

    $query_user_id=mysqli_query($connect, "SELECT id FROM users WHERE login='$name'");
    $result_user_id=mysqli_fetch_array($query_user_id);
    $user_id=$result_user_id['id'];
    
    $query_create_ticket=mysqli_query($connect, "INSERT INTO tickets SET user_init_id='$user_id', user_to_id='0', date_create='$add_time', subj='$subj', msg='$msg', client_id='$user_id', unit_id='6', status='0', arch='0', is_read='0', lock_by='0', ok_by='0', prio='1', last_update='$add_time', sla_plan_id='0'");
    $query_ticket_id=mysqli_query($connect, "SELECT id FROM tickets ORDER BY id DESC LIMIT 1");
    $result_ticket_id=mysqli_fetch_array($query_ticket_id);
    $ticket_id=$result_ticket_id['id'];

    $mail_msg="Новая заявка: http://zenlix/ticket?$ticket_id";

    $query_add_hash=mysqli_query($connect, "UPDATE tickets SET hash_name=$ticket_id WHERE id=$ticket_id");
    $query_add_ticket_info=mysqli_query($connect, "INSERT INTO ticket_info SET ticket_id='$ticket_id', ticket_source='web', ip='$ip', os='Windows',browser='Yandex'");
    $query_add_ticket_log=mysqli_query($connect, "INSERT INTO ticket_log SET date_op='$add_time', msg='create', init_user_id='$user_id', to_user_id='380', ticket_id='$ticket_id', to_unit_id='1'");

    mysqli_close($connect);

    mail("example","Техподдержка",$mail_msg, 'From: zenlix@mail.com');
    
    header('Location: form.php');
    exit;
?>