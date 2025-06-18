<!DOCTYPE HTML>
<html>
  <head lang="ru">
    <title>Заявки</title>
    <meta charset="utf-8" /> 
  </head>
  <body>
    <div class='flex'>
      <div style='width:100%'>
        <div class="clockpage">
        <?php
            //подключение файла конфигов
            require('../config/config.php');
            //подключение файла работы с бд
            require('../db/db_connect.php');
            //подключение файла запроса к бд
            require('../db/sql_query.php');

            echo file_get_contents($host['host'] . 'clock/clock.php');
        ?>
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
              $tickets=query_sql_assoc($query['get_active_tiket']);
              while ($result = mysqli_fetch_assoc($tickets)) {
                echo "<tr>
                <td>{$result['fio']}</td>
                <td>{$result['subj']}</td>
                <td class='desk'>{$result['msg']}</td>
              </tr>
                ";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
<? header("Refresh: ".$host['refresh']); ?>