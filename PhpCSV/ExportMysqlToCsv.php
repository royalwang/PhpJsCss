<?php

function exportCsv($gid = 0){
    	$gid = (int)$gid;
    	$uid = (int)$_SESSION['userid'];
    	header('Content-Type: text/csv; charset=utf-8');  
		header('Content-Disposition: attachment; filename=group-'.$gid.'.csv');  
		$o = fopen("php://output", "w");  
		fputcsv($o, array('Email','Name','City','Dofb'));
		$r = $this->db->query("SELECT email,name,city,dofb from newsletter WHERE groupid = $gid AND uid = $uid");  
		$rows = $r->fetchAll(PDO::FETCH_ASSOC); 
		foreach ($rows as $row) {
			fputcsv($o, $row);
		}
		fclose($o);
}
?>
    
