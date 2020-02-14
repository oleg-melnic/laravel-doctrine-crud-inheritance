<?php
/**
 * @desc Вывод массива в виде дерева
 *
 * @param array $array
 * @param string $str - строка для вывода после массива, например для проверки
 * @return void
 */
function pre()
{
	if (function_exists('is_production') && is_production()) return false;

	if (!headers_sent()) header('Content-type:text/html; charset=utf-8');

	$is_cli = php_sapi_name() == 'cli';

	echo(!$is_cli ? '<pre>' : '');

	foreach (func_get_args() as $arr)
	{
		print_r($arr);
		if (!is_array($arr) && !is_object($arr)) echo(!$is_cli ? '<br />' : "\n");
	}

	echo(!$is_cli ? '</pre>' : '');
}

/**
 * @desc Вывод массива в виде дерева и прекращение работы скрипта
 *
 * @param array $array
 * @param string $str - строка для вывода после массива, например для проверки
 * @return void
 */
function pred()
{
	if (function_exists('is_production') && is_production()) return false;

	if (!headers_sent()) header('Content-type:text/html; charset=utf-8');

	$is_cli = php_sapi_name() == 'cli';

	echo(!$is_cli ? '<pre>' : '');

	foreach (func_get_args() as $arr)
	{
		print_r($arr);
		if (!is_array($arr) && !is_object($arr)) echo(!$is_cli ? '<br />' : "\n");
	}

	die(!$is_cli ? '</pre>' : '');
}

/**
 * Вывод массива в виде дерева.
 * Преобразует все возможные символы в соответствующие HTML-сущности
 * @param array $array
 * @param string $str - строка для вывода после массива, например для проверки
 * @return void
 */
function pre_html()
{
	if (function_exists('is_production') && is_production()) return false;
	if (!headers_sent()) header('Content-type:text/html; charset=utf-8');

	echo('<pre>');
	foreach (func_get_args() as $arr)
	{
		if (!is_array($arr) && !is_object($arr))
		{
			$arr = str_replace('&gt;','&gt;<br />',htmlentities($arr));
		}
		print_r($arr);
		if (!is_array($arr) && !is_object($arr)) echo('<br />');
	}
	echo('</pre>');
}

/**
 * Вывод массива в виде дерева и прекращение работы скрипта.
 * Преобразует все возможные символы в соответствующие HTML-сущности
 * @param array $array
 * @param string $str - строка для вывода после массива, например для проверки
 * @return void
 */
function pred_html()
{
	if (function_exists('is_production') && is_production()) return false;
	if (!headers_sent()) header('Content-type:text/html; charset=utf-8');

	echo('<pre>');
	foreach (func_get_args() as $arr)
	{
		if (!is_array($arr) && !is_object($arr))
		{
			$arr = str_replace('&gt;','&gt;<br />',htmlentities($arr));
		}
		print_r($arr);
		if (!is_array($arr) && !is_object($arr)) echo('<br />');
	}
	die('</pre>');
}

/**
 * Вывести переданнцые элементы рядом для сравнения
 * @return void
 */
function pre_compare()
{
	if (function_exists('is_production') && is_production()) return;

	if (!headers_sent()) header('Content-type:text/html; charset=utf-8');

	echo('<table><tr>');

	foreach (func_get_args() as $arr)
	{
		echo('<td style="vertical-align:top;" ><pre>'.print_r($arr, 1).'</pre></td>');
	}

	echo('</tr></table>');
}

/**
 * Вывести переданнцые элементы рядом для сравнения
 * @return void
 */
function pred_compare()
{
	if (function_exists('is_production') && is_production()) return;

	if (!headers_sent()) header('Content-type:text/html; charset=utf-8');

	echo('<table><tr>');

	foreach (func_get_args() as $arr)
	{
		echo('<td style="vertical-align:top;" ><pre>'.print_r($arr, 1).'</pre></td>');
	}

	die('</tr></table>');
}

/**
 * @desc Вывод данных с помощью функции var_dump
 */
function vre()
{
	if (function_exists('is_production') && is_production()) return false;

	if (!headers_sent()) header('Content-type:text/html; charset=utf-8');
	echo('<pre>');
	$args = func_get_args();
	if (count($args) > 1)
	{
		$data = $args;
	}
	elseif (count($args) == 1)
	{
		$data = $args[0];
	}
	else
	{
		$data = null;
	}
	var_dump($data);
	echo('</pre>');
}

/**
 * @desc Вывод данных с помощью функции var_dump и прекращение раоты скрипта
 */
function vred()
{
	if (function_exists('is_production') && is_production()) return false;

	if (!headers_sent()) header('Content-type:text/html; charset=utf-8');
	echo('<pre>');
	$args = func_get_args();
	if (count($args) > 1)
	{
		$data = $args;
	}
	elseif (count($args) == 1)
	{
		$data = $args[0];
	}
	else
	{
		$data = null;
	}
	var_dump($data);
	die('</pre>');
}

/**
 * Функция для вывода дебага по времени выполнения скрипта
 * @return void
 */
function time_c()
{
	static $counter = -1, $time_data = array();
	$counter++;

	$time_data[$counter] = microtime(1);
	if ($counter > 0) pre('#'.$counter.' - '.round(microtime(1) - $time_data[0], 5).' c.');
}

/**
 * Функция для остановки скрипта во время дебага по времени
 * @return void
 */
function time_d()
{
	time_c();
	die;
}

/**
 * Отдавть в браузер PHP-файл с кодом переданного массива
 * @param array $data
 * @param boolean $serialize
 * @return void
 */
function array_view_file($data, $serialize = false)
{
	CLib_Debug::i()->disable();

	if (is_object($data) || $serialize) $data = serialize($data);

	if (is_array($data)) $array_str = array_build_view($data);
	elseif (is_string($data)) $array_str = "'".$data."';";
	else $array_str = '';

	$str = "<?php\n".
		'$data = '.$array_str;

	if (substr($file_name, strlen($file_name) - 4) != '.php') $file_name .= '.php';

	header("content-type: text/php");
	header('Content-Disposition: attachment; filename="'.$file_name.'"');
	die($str);
}

/**
 * Построить PHP-код массива
 * @param array $data
 * @param integer $level
 * @return string
 */
function array_build_view(array $data, $level = 0)
{
	$res = str_repeat("\t", $level)."array(\n";
	foreach ($data as $key => $value)
	{
		$res .= str_repeat("\t", $level + 1).
				(is_string($key) ? "'".str_replace("'", "\'", $key)."'" : $key)." => ";

		if (is_array($value))
		{
			$res .= array_build_view($value, $level + 1);
		}
		elseif (is_bool($value))
		{
			$res .= $value ? 'true' : 'false';
		}
		elseif (is_null($value))
		{
			$res .= 'null';
		}
		else
		{
			$res .= is_string($value) ? "'".str_replace("'", "\'", $value)."'" : $value;
		}

		$res .= ",\n";
	}

	$res .= str_repeat("\t", $level).')'.($level == 0 ? ';' : '');

	return $res;
}

/**
 * Получить название вызванного класса
 * @desc <pre>
 * Функция введена для обратной совместимости с PHP 5.2
 * </pre>
 * @return string
 */
if (!function_exists('get_called_class'))
{
	function get_called_class()
	{
		$bt = debug_backtrace();
		$lines = file($bt[1]['file']);
		preg_match('/([a-zA-Z0-9\_]+)::'.$bt[1]['function'].'/',
		$lines[$bt[1]['line']-1],
		$matches);
		return $matches[1];
	}
}

/**
 * Получить данные об используемых ресурсах (заглушка)
 * @retrun void
 */
if (!function_exists('getrusage'))
{
	function getrusage()
	{
		return array('ru_utime.tv_sec' => 0, 'ru_utime.tv_usec' => 0);
	}
}