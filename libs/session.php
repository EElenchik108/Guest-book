<?php

	function setSession($key, $value){
		$_SESSION[$key] = $value;
	}

	function issetSession($key) {
		return $_SESSION[$key] ?? null;		
	}

	function removeSession($key){
		if(issetSession($key)){
			unset($_SESSION[$key]);
		}
	}

	function setMessage($text, $type){
		setSession('message', compact('text', 'type'));
	}

	function showMessage(){
		if(issetSession('message')) {
			extract(issetSession('message'));
			if(is_array($text)) {
				$text = '<ul><li>' . implode('</li><li>', $text) . '</li></ul>';
			}
			echo "<div class='alert alert-{$type}'> {$text} </div>";
		}
	}

	function getError($name) {
		return $_SESSION['message']['text'][$name] ?? null;
	}

	




	


