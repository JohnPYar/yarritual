<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><?php echo $heading_title; ?></h1>
      <div class="buttons">
	  <a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a>
	  <a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
	      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
	
		<table id="module" class="list">
		 <thead>
            <tr>
              <td class="left"> <?php echo $id; ?></td>
              <td class="left"> <?php echo $date; ?></td>
              <td class="left"> <?php echo $name; ?></td>
              <td class="left"> <?php echo $phone; ?></td>
              <td class="left"> <?php echo $message; ?></td>
              </tr>
          </thead>
		    <tbody id="module-row">
			<?php
			if(!empty($history))
			{
			  foreach ($history as $history) { ?>
			<tr>
			<td class="left">
				<?php echo $history['id']; ?>&nbsp;&nbsp;<input type="checkbox" name="selected[]" value="<?php echo $history['id']; ?>" style=" width:20px; height:20px;" /></td>
			<td class="left"><?php echo date('d-m-y',$history['date']); ?></td>
              <td class="left"><?php echo $history['name']; ?></td>
              <td class="left"><?php echo $history['phone']; ?></td>
              <td class="left"><pre><?php echo $history['message']; ?></pre></td>
			</tr>
			 <?php } }		 
			?>
			</tbody>
		</table>
		
</form>		
    </div>
  </div>
</div>

<?php echo $footer; ?>