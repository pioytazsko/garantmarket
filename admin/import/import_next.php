<?php

session_start();

if ( !isset($_SESSION['import_end']) || ($_SESSION['import_end'] == 0) )
{
  echo '<p>Импорт данных из файла '.$_SESSION['import_file'].' в БД MySQL произведен успешно.</p>';
}
else
{
  echo '<p><b>Импорт данных из файла '.$_SESSION['import_file'].' в БД MySQL успешно завершен!</b></p>';
}
echo '<p>Количество импортированных позиций за последний сеанс: '.$_SESSION['sess_items'].'</p>';
echo '<p>Общее количество импортированных позиций: '.$_SESSION['total_items'].'</p>';
echo '<p>Сеанс процедуры импорта выполнялся: '.$_SESSION['exec_time'].' секунд</p>';

if ( !isset($_SESSION['import_end']) || ($_SESSION['import_end'] == 0) )
{
  echo "<br />\n";
  echo "<form name=\"FormImportStep\" method=\"post\" action=\"xml.php\">\n";
  echo "<input type=\"submit\" name=\"ActionOK\" value=\"Продолжить\">&nbsp;&nbsp;&nbsp;\n";
  echo "<input type=\"submit\" name=\"ActionCancel\" value=\"Остановить\">\n";
  echo "</form>\n";
}

?>
