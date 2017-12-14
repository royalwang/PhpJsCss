<?php
// Php prevent Mysql SQL Injection !!!

	function entitiesDecode($str) {	
		$subs[] = array("#semi#", "#amp#", "#quot#", "#apos#", "#lt#", "#gt#", "#colon#", "#equals#", "#excl#", "#slash#");
		$reps[] = array(";", "&", "\"", "'", "<", ">", ":", "=", "!", "\\");	
		$j = 0;
		foreach ($subs as $v) {
			$str = str_replace($v, $reps[$j], $str);
			$j++;
		}	
		return $str;
	}

	function entitiesEncode($str) {		
		$subs[] = array(";", "&", "\"", "'", "<", ">", ":", "=", "!", "\\");	
		$reps[] = array("#semi#", "#amp#", "#quot#", "#apos#", "#lt#", "#gt#", "#colon#", "#equals#", "#excl#", "#slash#");
		$j = 0;
		foreach ($subs as $v) {
			$str = str_replace($v, $reps[$j], $str);
			$j++;
		}	
		return $str;
	}
  
  ?>
