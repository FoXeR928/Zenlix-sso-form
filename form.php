<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание заявок</title>
    <link rel="stylesheet" href="./style.css" type="text/css">
</head>
<body>
<?php
    $name=$_SERVER['PHP_AUTH_USER'];
    $connect=mysqli_connect('localhost', 'mysql_user', 'mysql_pass', 'zenlix_table');
    mysqli_set_charset($connect, "utf8");
    $query_user_id=mysqli_query($connect, "SELECT id FROM users WHERE login='$name'");
    $result_user_id=mysqli_fetch_array($query_user_id);
    $user_id=$result_user_id['id'];
?>
    <form method="POST" action="db_connect.php" class="form">
        <label>Логин пользователя: <?php echo $name ?></label>
        <div class="conteiner">
            <label for="subj">Тема</label>
            <select class="form__select -input" style="width: 100%" id="subj" name="subj">
                <option value="Без темы">Выберите проблему</option>
                <option value="Интернет и локальная сеть">Интернет и локальная сеть</option>
                <option value="Проблема с почтой">Проблема с почтой</option>
                <option value="Телефон">Телефон</option>
                <option value="Компьютер">Компьютер</option>
                <option value="Замена картриджа">Замена картриджа</option>
                <option value="Принтер и сканер">Принтер и сканер</option>
                <option value="Установка программ">Установка программ</option>
                <option value="Проблема с программой">Проблема с программой</option>
                <option value="1C (ERP,ЗУП,СЭД)">1C (ERP,ЗУП,СЭД)</option>
            </select>
        </div>
        <div class="conteiner" style="display:flex; flex-direction: column;">
            <label for="msg" class="col-sm-2 control-label"><small>Текст:</small></label>
            <textarea class="form__textarea -input" data-toggle="popover" data-html="true" data-trigger="manual" data-placement="right" data-content="<small>Укажите подробно суть заявки</small>" placeholder="Описание проблемы" class="form-control input-sm animated" name="msg" id="msg" required data-validation-required-message="Укажите сообщение" aria-invalid="false" wrap="soft" style="min-height: 86px; resize: none;"></textarea>
        </div>
        <div class="conteiner" style="display:flex; flex-direction: row; justify-content: center;">
            <input id="enter_ticket" value="Создать заявку" class="btn btn-success" type="submit" name='send' style="width:50%">
            <input id="reset_ticket" value="Очистить поля" class="btn btn-default" style="width:50%" name="clear" type="submit">
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Проблема</th>
                <th>Описание</th>
                <th>Состояние</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query_user_request=mysqli_query($connect, "SELECT subj, msg, status FROM tickets WHERE user_init_id='$user_id' ORDER BY id DESC LIMIT 5");
                while ($result_user_request=mysqli_fetch_assoc($query_user_request)){
            ?>
            <tr>
                <td><?php echo $result_user_request['subj']; ?></td>
                <td><?php echo $result_user_request['msg']; ?></td>
                <td class=<?="status".$result_user_request['status']?> style="text-align: center; vertical-align: middle;">
                    <?php 
                    if ($result_user_request['status']==0):
                        echo 'Выполняется';
                    elseif ($result_user_request['status']==1):
                        echo 'Выполнено';
                    endif
                    ?>
                </td>
            </tr>
            <?php }?>    
	    </tbody>
    </table>
</div>
</body>
</html>