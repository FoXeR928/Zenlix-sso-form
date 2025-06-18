<!DOCTYPE HTML>
<html>
  <head lang="ru">
    <title>Заявки</title>
    <meta charset="utf-8" /> 
    <link rel="stylesheet" href="../css/style_clock.css" type="text/css">
  </head>
  <body>
    <div class='flex'>
      <div style='width:100%'>
        <div class="clockpage">
          <h1 id="clock" class="clock"></h1>
          <script>
            function time() {
              var d = new Date();
              var s = String(d.getSeconds()).padStart(2,'0');
              var m = String(d.getMinutes()).padStart(2,'0');
              var h = String(d.getHours()).padStart(2,'0');
              document.getElementById('clock').textContent=`${h}:${m}:${s}`;
            }
            setInterval(time, 1000);
          </script>
        <table class="table">
        <thead>
            <tr>
              <th>ФИО</th>
              <th>Тема</th>
              <th>Описание</th>
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

              $tickets=query_sql_assoc($query['get_active_tiket']);
              while ($result = mysqli_fetch_assoc($tickets)) {
            ?>
            <tr>
              <td class='text_center'><?php echo $result['fio'];?></td>
              <td class='text_center'><?php echo $result['subj'];?></td>
              <td class='desk'><?php echo $result['msg'];?></td>
            </tr>
          <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
<?php header("Refresh: ".$host['refresh']); ?>