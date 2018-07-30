<?php

class MSWord{
   /**
    * @desc  Generate a word document and  download.
    * @param string $content
    * @param string $filename
    */   
   public static function saveAndDownload($content, $filename='new_file.doc'){
       if (empty($filename)){
           $filename = date('YmdHis').'.doc';
       }
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=$filename");
        
        $html = '<html xmlns:v="urn:schemas-microsoft-com:vml"
         xmlns:o="urn:schemas-microsoft-com:office:office"
         xmlns:w="urn:schemas-microsoft-com:office:word"
         xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
         xmlns="http://www.w3.org/TR/REC-html40">';
        $html .= '<head><meta charset="UTF-8" /></head>';
        
        echo $html . '<body>'.$content .'</body></html>';
    }
}

