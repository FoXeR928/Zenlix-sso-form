<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание заявок</title>
    <link rel="stylesheet" href="./css/style.css" type="text/css">
</head>
<body>
<?php
    //получение имя пользователя домена
    $name=$_SERVER['PHP_AUTH_USER'];
    require('./config/config.php');
?>
    <form method="POST" action=<?php echo $host['host'] . "form_api/form_post.php" ?> class="form">
        <label>Логин пользователя: <?php echo $name; ?></label>
        <div class="conteiner flex-column">
            <label for="subj">Тема</label>
            <select class="form__select -input" id="subj" name="subj">
                <option value="Без темы">Выберите проблему</option>
                <option value="Интернет и локальная сеть">Интернет и локальная сеть</option>
                <option value="Проблема с почтой">Проблема с почтой</option>
                <option value="Выдать флешку">Выдать флешку</option>
                <option value="Телефон">Телефон</option>
                <option value="Компьютер">Компьютер</option>
                <option value="Инциденты ИБ">Инциденты ИБ</option>
                <option value="Замена картриджа">Замена картриджа</option>
                <option value="Принтер и сканер">Принтер и сканер</option>
                <option value="Установка программ">Установка программ</option>
                <option value="Проблема с программой">Проблема с программой</option>
                <option value="1C (ERP,ЗУП,СЭД)">1C (ERP,ЗУП,СЭД)</option>
		        <option value="Продукты ASCON(KOMPAS, Loodsman, Polynom, Vertical)">Продукты ASCON(KOMPAS,Loodsman,Polynom,Vertical)</option>
            </select>
        </div>
        <input type="hidden" name='user' value="<?php echo $name ?>">
        <input type="hidden" name='ip' value="<?php echo @$_SERVER['REMOTE_ADDR']; ?>">
        <div class="conteiner flex-column">
            <label for="msg"><small>Текст:</small></label>
            <textarea id="textinfo" class="form__textarea -input -textarea" placeholder="Описание проблемы" name="msg" id="msg" required></textarea>
        </div>
        <div class="conteiner flex-row">
            <input id="enter_ticket" value="Создать заявку" class="btn btn-success btn-send" type="submit" name='send'>
            <input id="reset_ticket" value="Очистить поля" class="btn btn-default btn-send" name="clear" type="submit">
        </div>
    </form>
    <?php
        //создание переменной для запроса списка заявок
        $get=array('name'=>$name);
        //отправка запроса к списку заявок
        $url=$host['host'] . 'form_api/user_list_get.php?';
        $list=file_get_contents($url . http_build_query($get));
        //вывод списка заявок
        echo $list;
    ?>              
</body>
</html>
        