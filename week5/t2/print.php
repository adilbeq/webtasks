<?php
	function print_sepated($s, $dele=','){
		$res = "";
		$string = str_split($s);
		foreach ($s as $char) {
			$res.=.$char;
		}
		return $res;
	}
	print_sepated("zxcs");
?>