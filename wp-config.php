<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'main' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'QzC?v6:z;N&u5@%DW?yt*a0e&{&$s:81h_V#RzPw}&g(Vs>7HDn(q>,Nl6@kBJ<a' );
define( 'SECURE_AUTH_KEY',  'G7b8E Eb8]<p$*wO-7,S):]SpSO2U.R&bM4Y&c.4h2MGQ.@wX7uYz`NO]H_ank-=' );
define( 'LOGGED_IN_KEY',    '`PeASHn2s:a$E1dAY4*=[@jj Ormcb tyvvM(S5!J;)@&POS n6jB@ /0x[+@@{W' );
define( 'NONCE_KEY',        'SplYW#EJ5dbD}czvNep<+s=x0OpGh#g,sV1?1+Gp>WSTG-+/q#JEyt@h%PO.tKcM' );
define( 'AUTH_SALT',        'qI=F8i0Te!nck9UFil ~n<-Es_jN&$&@0~/}n}j%ccg0BH1!>D+q 7C^_[rUfFba' );
define( 'SECURE_AUTH_SALT', 'dx:$1;Qj+9$I;MCF-5}:6Sro!oeu^r=bgqKjL;.QH[_O.RcVtO#u~)E{d/lY8&s>' );
define( 'LOGGED_IN_SALT',   'jYH5nhljKuK3^uz80,*:(sa5j#7[0ZRCJEf&zcv2;vP}rQ&Ul-c<]2e!vq{8b@3e' );
define( 'NONCE_SALT',       '&__M{I(-,v#FGpN^+}ba!HgLEhqd,Qx|$$+YR^v=NkXD;@pVYXAibC%e|OXxoV&7' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'main_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
