<?php
date_default_timezone_set("Asia/Seoul");
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('memory_limit', '128M');
set_time_limit (0);

// reference http://stackoverflow.com/questions/4356289/php-random-string-generator
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$length = isset($_GET['length']) ? $_GET['length'] : 10;
$length = intval($length) == 0 ? 10 : intval($length);

$randstr = generateRandomString($length); 
if (isset($_GET['api']) && $_GET['api'] == 'true'){
	echo $randstr;
	exit();
}


$formtag = <<<CDATA
<form method="GET">
		<div>
			<span class='itemname'>문자열 길이 : </span>
			<span class='itemvalue'>
				<input type='text' name='length' value='$length' class='itemvalue' />
			</span>
		</div>
		<div>
			<span class='itemname'>API인가요? : </span>
			<span class='itemvalue'>
				<select name='api' class='itemvalue'>
					<option value='true'>네</option>
					<option value='false' selected='selected' >아니오</option>
				</select>
			</span>
		</div>
		<div>
			<input type='submit' value='랜덤 문자열 생성' />
		</div>
		</form>
		<hr />

		<div>		
			<span class='itemname'>결과 : </span>
			<span class='itemname'><input type='text' value='$randstr' /></span>		
		</div>
CDATA;
$template = file_get_contents('templates/sosimple.html');
$template = str_replace("{{content}}", $formtag, $template);

echo $template;

// 아니면 숫자를 입력할 수 있게 폼 만들어줌.
?>