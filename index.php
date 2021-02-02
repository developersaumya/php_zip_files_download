
if(isset($_POST['submit']))
{
   /* create a compressed zip file */
   $part=$_POST['part'];
   $p=$_POST['p'];


/* create a compressed zip file */
function createZip($files = array(), $destination = '', $overwrite = false, $part) 
{
   $dir="procedure/";

   $validFiles = [];
   if(is_array($files)) 
   {
      foreach($files as $file) {
         if(file_exists($dir.$file)) {
            $validFiles[] = $dir.$file;
         }
      }
   }

   if(count($validFiles)) 
   {
      $zip = new ZipArchive();
      $opened = $zip->open($part.'.zip', ZIPARCHIVE::OVERWRITE | ZIPARCHIVE::CREATE);
      //die($opened);
      if( $opened !== true ){
        // die("cannot open for writing.");
      }
      else
      {
        //    die("DONE for writing.");
      }  

      foreach($validFiles as $file) {
         $zip->addFile($file);
      }

      
      $zip->close();
      return true; //file_exists($destination);
   }else{
  // die("NO");
      return false;
   }
}

//$partt = "test_fol.zip" ;
//$date=date('Y-m-d H:i:s');
//$r = rand(11,99);
$fileName = $part.'.zip';
//$fileName = 'i.zip';
$files_to_zip =   $p; //['remove-icon.png', 'ddlogo.png','467724274Open_Issue_List.xls'];
$result = createZip($files_to_zip, $fileName,'',$part);

// if(file_exists($part.'.zip'))
// {
//    echo "YES";
//    unlink($fileName);
// }

header("Content-Disposition: attachment; filename=\"".$fileName."\"");
header("Content-Length: ".filesize($fileName));
readfile($fileName);



}


