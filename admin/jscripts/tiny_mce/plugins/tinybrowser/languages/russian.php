<?php
/*********************************************************************************************
 * MODx PLUGIN: Basic Manager
 * VERSION:     1.0
 * DESCRIPTION: File Manager
 * WRITTEN BY:  Kobezzza (kobezzza@mail.ru)
 * DATE:        29/09/2010
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *********************************************************************************************/

define('TITLE', 'Файловый менеджер');

define('ORDER_TITLE', 'Упорядочивание содержимого этой папки');
define('VIEWS_TITLE', 'Выбор способа просмотра содержимого этой папки');
define('CREATE_TITLE', 'Создание новой папки, изображения или Json коллекции');
define('DOWNLOAD_TITLE', 'Импортирование файлов в эту папку');

define('SEARCH_VALUE', 'Поиск');
define('SEARCH_TITLE', 'Введите текст для поиска в текущем отображении');

define('REFRESH_TITLE', 'Обновить содержимое этой папки');

define('ORDER_NAME', 'По имени');
define('ORDER_SIZE', 'По размеру');
define('ORDER_FORMAT', 'По формату');

define('VIEWS_TABLE', 'Таблица');
define('VIEWS_PLATE', 'Плитка');
define('VIEWS_LIST', 'Список');

define('IMAGES', 'Изображения');
define('MEDIA', 'Медиа');
define('FLASH', 'Флеш');
define('FILES', 'Файлы');

define('CREATE_IMG', 'Изображение');
define('CREATE_FOLDER', 'Папку');
define('CREATE_JSON_COLLECTION', 'Json коллекцию');

define('MANAGER_IMG', 'Работа с изображениями:');
define('MANAGER_OTHER', 'Различные настройки:');

define('REWRITE_NAME', 'Обрезать имена файлов и папок в режиме плитка?');
define('REWRITE_WIDTH', 'Лимит символов до обрезания:');

define('CREATE_THUMB', 'Создавать уменьшенную копию изображений?');
define('WH_THUMB', 'Ширина и высота уменьшенной копии (в пикселях):');

define('RESIZE_IMG', 'Изменять размер загруженных изображений?');
define('WH_IMG', 'Ширина и высота изображений (в пикселях):');

define('SYSTEM_THUMB', 'Подкладывать подложку под системные превью?');

define('SAVE_PREF', 'Сохранить настройки');

define('YEAS', 'Да');
define('NO', 'Нет');

define('MANAGER_PREF', 'Настройки менеджера');

define('ROOT_FOLDER', 'Корневые папки');
define('THIS_ROOT', 'Папки этого уровня');

define('ERROR_DELETE_CAT', 'Папка не была удалена');
define('ERROR_DELETE_FILE', 'Файл не был удалён');
define('ERROR_RENAME_1', 'Вы не указали нового имени');
define('ERROR_RENAME_2', 'Такое имя в этой папке уже занято');
define('ERROR_RENAME_3', 'Новое имя не было сохранено');
define('ERROR_NEW_CAT_1', 'Вы не указали имени новой папки');
define('ERROR_NEW_CAT_2', 'Такое имя в этой папке уже занято');
define('ERROR_NEW_CAT_3', 'Папка не была создана');
define('ERROR_UPLOAD_1', 'Такой формат файлов не поддерживается!');
define('ERROR_SAVE_FILE_1', 'Неверный формат файла, файл не был загружен');
define('ERROR_SAVE_FILE_2', 'Файл не был загружен');
define('ERROR_SAVE_FILE_3', 'Объём файла превышает допустимый');
define('ERROR_ROLE', 'У вас нету прав на этой действие');
define('ERROR_REFRESH', 'Ошибка при обновлении папки');
define('ERROR_CREATE_JSON_COLLECTION_1', 'Вы не указали имени коллекции');
define('ERROR_CREATE_JSON_COLLECTION_2', 'Ошибка при создании коллекции');

?>