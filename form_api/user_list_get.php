<body>
    <table class="table">
        <thead>
            <tr>
                <th>Дата создания</th>
                <th class='th_problem'>Проблема</th>
                <th>Описание</th>
                <th class='th_status'>Состояние</th>
                <th>Дата закрытия</th>
            </tr>
        </thead>
        <tbody>
        <?php
            //подключение файла конфигов
            require('../config/config.php');
            //подключение файла работы с бд
            require('../db/db_connect.php');
            //подключение файла запроса к бд
            require('../db/sql_query.php');
            
            //получение имени пользователя
            $name=$_GET['name'];
            //получение id пользователя
            $user_id=query_sql_array("SELECT id FROM users WHERE login='$name'")['id'];
            //проверка естьли пользователь в системе
            if($user_id==None){
                //отправка письма о добавление пользователя
                mail($mail_list['it_admin'], $mail_header['mail_new_user'],sprintf($mail_text['mail_no_user'],$name), $mail_header['mail_from']);
	        }else{
                //запрос заявок пользователя
                $user_tickets=query_sql_assoc(sprintf($query['get_tickets'],$user_id,$query_config['number_applications']));
            //вывод заявок пользователя
            while ($user_ticket=mysqli_fetch_assoc($user_tickets)){
                $ticket_comments=query_sql_assoc(sprintf($query['get_comments'],$user_ticket['id']));
        ?>
                <tr>
                    <td class="text_center"><?php echo $user_ticket['date_create'];?></td>
                    <td><?php echo $user_ticket['subj']; ?></td>
                    <td><?php echo $user_ticket['msg']; ?></td>
                    <?php
                        $check_status=query_sql_array(sprintf($query['find_reject'],$user_ticket['id'],$query_config['rejected_text']))['comment_text'];
                        //Проверка статуса заявки
                        if ($user_ticket['status']==1 AND !empty($check_status)){
                            $output_status='Отклонено';
                            $status=2;
                        }elseif ($user_ticket['status']==0){
                            $output_status='Выполняется';
                            $status=0;
                        }elseif ($user_ticket['status']==1){
                            $output_status='Выполнено';
                            $status=1;
                        }
                    ?>
                    <td class="text_center <?php echo "status".$status?>"><?php echo $output_status;?></td>
                    <td class="text_center"><?php echo $user_ticket['ok_date']; ?></td>
                </tr>
                <?php
                    while ($ticket_comment=mysqli_fetch_assoc($ticket_comments)){
                            $user_id=query_sql_array(sprintf($query['get_fio'],$ticket_comment['user_id']));
                ?>
                <tr>
                    <td class='td_comment' colspan=5>
                        <div class="comment_container">
                            <small class="small_name"><?php echo $user_id['fio']?></small>
                            <p class="comment_text"><?php echo $ticket_comment['comment_text'];?></p>
                        </div>
                    </td>
                </tr>
                <?php }?>
                <?php }?>
            <?php }?>    
        </tbody>
    </table>
</body>
