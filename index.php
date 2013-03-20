<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>regExp-filter</title>

<script type="text/javascript" language="javascript" src="js/jquery-1.9.1.js"></script>

<style type="text/css">

	body {font-family:Consolas; font-size:12px; padding:7px 7px 7px 0;}

	textarea, input, pre {font-family:Consolas; line-height:15px;}
	
	div#wrapper {}
	
	div#output {margin: 20px 0 0 0; background: rgb(233, 223, 223); padding: 10px; display:none; }
	
	input#process {display:none;}
	
</style>

</head>

<body>

	<div id="wrapper">
    
    	<h2>regExp-filter v1.0</h2>
    
        <form id="filter" method="post">
        
            RegExp: <input type="text" name="regexp" id="regexp" style="width:800px;" value="[\w\.\-]+@[\w\.\-]+\.[A-Za-z]{2,7}?" /> <em>Default: e-mail filter</em>
            
            <br /><br />
            
            <textarea cols="100" rows="12" tabindex="1"  spellcheck="false" id="text" style="margin-left: 0px; height: 300px; width: 100%;"></textarea>
            
            <input type="submit" id="grab" value="Grab" />
            
            <input type="button" id="process" value="Process &raquo;" />
            
       	</form>
        
        <div id="output"></div> <!--/output-->
        
    </div> <!--/wrapper-->
    
    <script type="text/javascript">
	
		$('#filter').submit(function() {
			
			if ( $.trim( $('#text').val() ) != '' )
			{
				$.ajax({
					type: "POST",
					url: "ajax.php",
					data: { action: 'grab', text: $('#text').val(), regexp: $('#regexp').val() }
				}).done(function( msg ) {
					$('#output').css("display","block");
					$('#output').html( '<pre>' + msg + '</pre>' );
					
					if ( msg != "No matched results.")
					{
						$('#process').css("display","inline-block");
					}
				});	
			}
			else
			{
				$('#output').css("display","block");
				$('#output').html( '<p>No data found.</p>' );
			}
			
			return false;
		  
		});
		
		$('#process').on("click", function(event){
  			
			$.ajax({
				type: "POST",
				url: "ajax.php",
				data: { action: 'process', text: $('#text').val(), regexp: $('#regexp').val() }
			}).done(function( msg ) {
				$('#output').css("display","block");
				$('#output').html( '<pre>' + msg + '</pre>' );
			});
			
		});
	
	</script>

</body>
</html>