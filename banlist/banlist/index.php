<?php
/*

		ИНФОРМАЦИЯ:
			Банлист v1.1.0 UTF-8
			Автор: GamerVII
			Страница ВК: http://vk.com/gamervii
		
		ВНИМАНИЕ!
			Если данный файл не является конфигурационным, то при отсутствии у Вас знаний и навыков
			программирования на языке PHP любое Ваше здесь изменение может привести к нестабильной работе банлиста.
			Редактируйте данный код только при указании тех. поддержки, оказываемой автором данного скрипта!
		
		По любым вопросам обращайтесь к автору данного кода http://vk.com/gamervii или в беседу ВК https://vk.me/join/AJQ1dzFlXwzCO9cs6CAwTvmw
		
	
*/

//if(!defined('DATALIFEENGINE')) die("Нет доступа!"); # Раскоментировать(убрать два обратных слеша в начале строки) эту строчку, если будет ошибка: Hacking attempt!

# Подключение фала конфигураций
include_once "config.php";

# Получение данных из таблицы
$resault = $pdo->query("SELECT * FROM $db_table");

# Создание базовой структуры таблицы
$banlist .= "
<table cellspacing='0' width='$table_width' style='background: $table_background;'>
<tr>
<td><b>Игрок</b></td>
<td><b>Забанил</b></td>
<td><b>Причина</b></td>
<td><b>Дата блокировки</b></td>
<td><b>Дата разблокировки</b></td>
</tr>";

#	Добавление в структуру банличта полей с пользователями
while($row = $resault->fetch(PDO::FETCH_ASSOC)){
	if(!$row['temptime']) $unban = "<span style='color: $perm_color;>Перманентно</span>"; else $unban = date("d.m.Y H:i", $row['temptime']);
	$time = date("d.m.Y H:i", $row['time']);
	$nickname = $row['name'];
	$banlist .= "
	<tr>
	<td>$nickname</td>
	<td>{$row['admin']}</td>
	<td>{$row['reason']}</td>
	<td>$time</td>
	<td>$unban</td>
	</tr>";
}

#	Вывод банлиста
echo "$banlist";
?>

<!-- Дополнительные стили к таблице -->
<style>
td,b{
	color: <? echo "$table_color";?> !important;
}
td{
	padding: <? echo "$table_padding";?>;
}
</style>