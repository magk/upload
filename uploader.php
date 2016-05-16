<?php
if(isset($_POST["submit"]))
{
	$filename = $_FILES["file"]["name"];
	$path = dirname(__FILE__)."\\files\\";
	$file_basename = substr($filename,0,strripos($filename,".")); //get basename file
	$file_ext = substr($filename,strripos($filename,".")); //get ext file
	$file_size = $_FILES["file"]["size"];
	$allowed_file_type = array(".txt",".doc",".docx",".pdf",".jpg",".jpeg");
	
	if(in_array($file_ext,$allowed_file_type)&&$file_size<1000000)
	{
		$new_filename = md5($file_basename).$file_ext;
		if(file_exists($path.$new_filename))
		{
			echo "File already exist.";
		}
		else {
			move_uploaded_file($_FILES["file"]["tmp_name"],$path.$new_filename);
			echo "File uploaded successfully.";
		}
	}
	elseif (empty($file_basename))
	{
		echo "Please select a file to upload.";
	}
	elseif ($file_size>1000000)
	{
		echo "file is too large.";
	}
	else {
		echo "Only these file types are allowed for upload: ".implode(",",$allowed_file_type);
		/* unlink($_FILES["file"]["tmp_name"]); */
	}
}

?>
<form>
<input type="button" onClick="parent.location='index.php'" value="Upload More"> 
</form>
