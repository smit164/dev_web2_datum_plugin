<?php
include "vendor/autoload.php";
//use Ghostscript\Transcoder;
use Ilovepdf\Ilovepdf;

try {
  
  $ilovepdf = new Ilovepdf('project_public_38e9169b628d1d5956850f06a73a3678_MdeUPae0eff300f7c3984fb280e389c48a3ec','secret_key_d8ca5fbfa93a57e9afa976aae0e20077_Ajh9H6a6412f9e14da3eb78f7be1d369d7f8b');
  
  $myTask = $ilovepdf->newTask('repair');
  // Add files to task for upload
  $file1=$myTask->addFile('notworking-1.pdf');
  // Execute the task
  $myTask->execute();
  // Download the package files
  $myTask->download();
} catch(Exception $e) {
  echo "<pre>";
	print_r($e);
}


die("TEST");