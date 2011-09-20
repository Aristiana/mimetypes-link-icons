<?php header("Content-type: text/css"); 
$mtli_height=$_GET['mtli_height'];
$mtli_image_type=$_GET['mtli_image_type']; 
echo ".mtli_attachment {  display:inline-block;  height:".$mtli_height."px;  background-position: top left; background-attachment: scroll; background-repeat: no-repeat; padding-left: ".($mtli_height*1.2)."px; }";
$mtli_available_mime_types = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'csv', 'zip', 'ppt', 'pptx', 'dwg', 'dwf', 'skp', 'jpg');
foreach($mtli_available_mime_types as $k=>$type){ 
	echo '.mtli_'.$type.' { background-image: url(../images/'.$type.'-icon-'.$mtli_height.'x'.$mtli_height.'.'.$mtli_image_type.'); }';
 } 
?>