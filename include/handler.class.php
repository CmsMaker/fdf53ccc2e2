<?php
//============================
// Handler Class program
// This program is not free software
// Developer : Zandmoghadam Farhad
// copyright (c) 2008 www.parsephp.com
//============================

class my_handler {

// set session
function set_session($name,$value) {
	$_SESSION["$name"] = $value;
}

// get Session whit name
function get_session($name) {
	if (isset($_SESSION["$name"])) {
		$my_session = $_SESSION["$name"];
	} else {
		$my_session = "";
	}
	return $my_session;
}

// delete session whit name
function del_session($name) {
	unset($_SESSION["$name"]);
	$_SESSION["$name"] = "";
}

// set cookie
function set_cookie($name,$value, $day = 0, $hour = 0, $min = 0) {
	$my_days = ($day * 24 * 60 * 60);
	$my_hour = ($hour * 60 * 60);
	$my_min = ($min * 60);
	$set_time = (time() + $my_days + $my_hour + $my_min);
	setcookie($name, $value, $set_time, '/');
}

// get cookie by name
function get_cookie($name) {
	if (isset($_COOKIE["$name"])) {
		$my_cookie = $_COOKIE["$name"];
	} else {
		$my_cookie = "";
	}
}

// delete cookie by name
function del_cookie($name) {
	unset($_COOKIE["$name"]);
	setcookie($name, "", time() - 86400, '/');
}

// End Class
}
?>
