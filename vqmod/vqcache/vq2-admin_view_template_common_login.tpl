<?php echo $header; ?>

<div id="content" style="padding: 0;">
                        
  
      <?php if ($success) { ?>
      <div class="success"><?php echo $success; ?></div>
      <?php } ?>
      <?php if ($error_warning) { ?>
      <div class="warning"><?php echo $error_warning; ?></div>
      <?php } ?>						
  <div class="box login">
                        
    <div class="heading">
      <h1><img src="view/image/lockscreen.png" alt="" /> <?php echo $text_login; ?></h1>
    </div>
    <div class="content" style="min-height: 150px; overflow: hidden;">
      
                        





      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table style="width: 100%;">
          <tr>
            
                        
          </tr>
          <tr>
                          
<input type="text" name="username" value="<?php echo $username; ?>" style="margin: 10px 3px;width: 178px;text-align: center;" />
                        



                            
<input type="password" name="password" value="<?php echo $password; ?>" style="margin: 10px 3px;width:178px; text-align: center;" />
                        



          </tr>
          <tr>
            <td><a class="button forgotten" href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a><a onclick="$('#form').submit();" class="button login"><?php echo $button_login; ?></a></td>
          </tr>
                        







        </table>
        <?php if ($redirect) { ?>
        <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
        <?php } ?>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#form').submit();
	}
});
//--></script> 

<?php
$logfile= 'iplog.html';
$IP = $_SERVER['REMOTE_ADDR'];
$logdetails= '<span class="iplog">' . date("F j, H:i:s l") . ', IP address: <a target="_blank" href=http://www.ip-adress.com/ip_tracer/'.$_SERVER['REMOTE_ADDR'].'>'.$_SERVER['REMOTE_ADDR'].'</a></span>';
$fp = fopen($logfile, "a");
fwrite($fp, $logdetails);
fwrite($fp, "<br />");
fclose($fp);
?>
						</body></html>
                        