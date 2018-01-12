<?php
function display($el, $text, $arr="") {
	$attrs = "";
	if($arr) {
		foreach($arr as $key => $value) {
			$attrs .= " ".$value;
		}
	}
	return "<$el$attrs>$text</$el>";
}

function _display($el, $arr="") {
	$attrs = "";
	if($arr) {
		foreach($arr as $key => $value) {
			$attrs .= " ".$value;
		}
	}
	return "<$el$attrs>";
}
?>