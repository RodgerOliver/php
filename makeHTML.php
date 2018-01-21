<?php
function makeHTML($el, $text, $arr="") {
	$attrs = "";
	if($arr) {
		foreach($arr as $value) {
			$attrs .= " ".$value;
		}
	}
	return "<$el$attrs>$text</$el>";
}

function _makeHTML($el, $arr="") {
	$attrs = "";
	if($arr) {
		foreach($arr as $key => $value) {
			$attrs .= " ".$value;
		}
	}
	return "<$el$attrs>";
}
?>