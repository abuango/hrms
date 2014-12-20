<?php

class FileManager {
    //put your code here
    
    var $uploadLocation;
    var $fileSize_restriction;
            
    function __construct($location = false, $fileSize = false) {
        $this->uploadLocation = $location;
        $this->fileSize_restriction = $fileSize;
    }
            
    function uploadfile($ufile, $utName, $uName){
		//echo $ufile."".$utName." ".$uName;
		$image_tempname = $utName;
		$mainDir = $this->uploadLocation;
		
                
                $filesize = round((filesize($ufile)/1024));
               // echo $filesize;
                if($filesize > $this->fileSize_restriction){
                    $status[0] = false;
                    $status[1] = $this->$fileSize_restriction." is the maximum size for upload but your file is ".$filesize."KB";
                    return $status;
                }
                
		$ext = substr($image_tempname, strrpos($image_tempname, '.'));
		$fileName = $mainDir . $image_tempname;
                
        //echo $fileName; exit();       
		
                
		if (move_uploaded_file($ufile,$fileName)) {
		
			$newfilename = $mainDir . str_replace('/', '', $uName) . $ext;
			if(file_exists($newfilename)){
				unlink($newfilename);
			}
			
			rename($fileName, $newfilename);
			//$newfilename = $mainDir . $uName . $ext;
			
                    $status[0] = TRUE;
                    $status[1] = $newfilename;
                    return $status;
		}else{
                    $status[0] = false;
                    $status[1] = "Sorry, we could not upload your file, can you please try again?";
                    return $status;
                }
        }
        
        function addFile($acc_id, $file, $desc, $type){
            global $db;
            
            // Types of files : 0 - Passport, 1 - General Files
            
            $db->insert(
                        'tbl_file_manager',
                        array(
                            'acc_id' => $acc_id,
                            'file_location'   => str_replace('../', '', $file),
                            'file_desc'   =>  $desc,
                            'file_type' => $type
                        )
                    );
            //echo $db->insert_i
            return $db->insert_id();
        }
        
         
        
        function deleteFile($file_id){
            global $db;
            
            $file = $db->dlookup('file', 'tbl_file_manager', 'file_id = ?', array($file_id));
            unlink($file);
            
            return $db->delete('tbl_file_manager', 'file_id = ?', array($file_id));
        }
        
        function getFileURL($file_id){
            global $db;
            
            return $db->dlookup('file_location', 'tbl_file_manager', 'file_id = ?', array($file_id));
        }
        
        
        function getFileDetails($file_id){
            global $db;
            
            return $db->dlookup('file_location, file_type, file_desc', 'tbl_file_manager', 'file_id = ?', array($file_id));
        }
}

?>
