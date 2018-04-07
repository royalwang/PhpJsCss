<?php

foreach ($_FILES["file"]["error"] as $key => $error) {
			    if ($error == UPLOAD_ERR_OK) {
			    	$ext =  pathinfo($_FILES['file']['name'][$key], PATHINFO_EXTENSION);
			    	if ($ext != 'csv' ) {
							$error = "Tylko pliki: .csv";
					}else{			    		
				        $tmp_name = $_FILES["file"]["tmp_name"][$key];
				        $log = '';
                if (($h = fopen($tmp_name, "r")) !== FALSE) {
                    while (($data = fgetcsv($h, 1024, ",")) !== FALSE) {
                        $num = count($data);
                        $uid = (int)$_SESSION['userid'];
                        // ID grupy subskrybentów
                        $gid = (int)$_GET['gid'];
                        $mail = htmlentities($data[0],ENT_QUOTES,'utf-8');
                        $name = htmlentities($data[1],ENT_QUOTES,'utf-8');
                        $city = htmlentities($data[2],ENT_QUOTES,'utf-8');
                        $dofb = htmlentities($data[3],ENT_QUOTES,'utf-8');
                        $ip = $_SERVER['REMOTE_ADDR'];
                        try{
                          if (filter_var($mail, FILTER_VALIDATE_EMAIL) === false) {
                            $log .= '[ERROREMAIL|'.$mail.']';	
                          }else{
                            $st = $pdo->db->query("INSERT INTO newsletter(uid,groupid,email,name,city,dofb,ip,active,code) VALUES($uid,$gid,'$mail','$name','$city','$dofb','$ip',1,'csv')");
                            // $log .= '<p class="toperror">Adres email zapisany do newslettera '.$mail.'</p>';
                          }
                        } catch (Exception $e) {													
                          $log .= '[DUPLICATE|'.$mail.'] ';
                        }
                    }						    
                    fclose($h);
                    echo $log;
                    echo "<h2>Import subskrybentów zakończony!</h2>";						    
                }
			    	}
			    }else{
			    	echo "<h2>Coś nie tak. Upload error!</h2>";
			    }
			}
      
  ?>
