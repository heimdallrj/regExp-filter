<?php
$action = $_POST['action'];
$regexp = '/' . $_POST['regexp'] . '/U';

$grabage_text = $_POST['text'];

if ( trim($grabage_text) != '' )
{
	preg_match_all ($regexp, $grabage_text, $output);
	
	$output_e = array_filter($output);
	
	if ( empty($output_e) != TRUE )
	{
	
		$output = array_unique($output[0]);
		asort($output);
		
		
		
		if ( $action == 'grab' ) { print_r($output); }
		
		if ( $action == 'process' ) 
		{	  
			$file_path = strtotime(date("Y-m-d H:i:s"));
			$file_path = 'lists/' . $file_path . '.txt';
			$fp = fopen($file_path, 'w');
			
			echo '<p><a href="' . $file_path . '" target="_blank">Download the Data file</a></p>';
			
				foreach ( $output as $email)
				{
					$email = strtolower($email);
					fwrite($fp, $email . "\r\n" );
					echo $email . ' -- Ok <br/>';
				}
			
			fclose($fp);
		}
	}
	else
	{
		echo 'No mathched results!.';
	}
}
else
{
	echo 'No mathched results to process!.';
}