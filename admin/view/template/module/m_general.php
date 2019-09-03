
<div class="form-horizontal ft-contacts">

    <h4><?php echo $text_generalsett; ?></h4>
  <hr />
	<div class="row-fluid">
		<div class="span2"><?php echo $text_responsive; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $gen_responsive; $name	= 'gen_responsive'; $id = 'gen_responsive';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	</div><hr />
    
               
 <div class="row-fluid">
					<div class="span2"><?php echo $text_site_position; ?></div>
					<div class="span10 alltheme">
						<?php 
							$ar 	= array( 'Position 1' =>1 , 'Position 2' =>2  ); 
							$valueq 	= $site_position; $name	= 'site_position'; $id = 'site_position';
						?>
						<div class="btn-group" data-toggle="buttons-radio">
							<?php foreach ($ar as $key => $value) { ?>
								<?php ($value ==  $valueq) ? $selected = ' active' : $selected=''; ?>
								<label for="<?php echo $id . '-' . $value; ?>"  type="button" class="btn<?php echo $selected; ?> <?php echo $id . '-' . $value; ?>">
									<input type="radio" id="<?php echo $id . '-' . $value; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" <?php if ($valueq == $value) { ?>checked="checked"<?php }?>>
									<?php echo $key; ?>
								</label>
							<?php } ?>
						</div>
					</div>
				</div> <hr />                  
       
   <div class="row-fluid">
		<div class="span2"><?php echo $text_fixmenu; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $fixmenu; $name = 'fixmenu'; $id = 'fixmenu';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	</div><hr>
   
     <div class="row-fluid">
		<div class="span2"><?php echo $text_topcontrol; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $topcontrol; $name = 'topcontrol'; $id = 'topcontrol';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	</div><hr>
   <div class="row-fluid">
					<div class="span2"><?php echo $text_colorsite; ?></div>
					<div class="span10">
                        <div class="scheme1"></div><div class="scheme2"></div><br />
						<?php 
							$ar 	= array( 'Color 1' =>'1' , 'Color 2' =>'2' ); 
							$valueq 	= $colorsite; $name	= 'colorsite'; $id = 'colorsite';
						?>
						<div class="btn-group" data-toggle="buttons-radio">
							<?php foreach ($ar as $key => $value) { ?>
								<?php ($value ==  $valueq) ? $selected = ' active' : $selected=''; ?>
								<label for="<?php echo $id . '-' . $value; ?>"  type="button" class="btn<?php echo $selected; ?>">
									<input type="radio" id="<?php echo $id . '-' . $value; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" <?php if ($valueq == $value) { ?>checked="checked"<?php }?>>
									<?php echo $key; ?>
								</label>
							<?php } ?>
						</div>
					</div>
				</div><hr>      
  <div class="row-fluid">
					<div class="span2"><?php echo $text_menu_full; ?></div>
					<div class="span10">
						<?php 
							$ar 	= array( 'Fixed' =>0 , 'Full' =>1 ); 
							$valueq 	= $menu_width; $name	= 'menu_width'; $id = 'menu_width';
						?>
						<div class="btn-group" data-toggle="buttons-radio">
							<?php foreach ($ar as $key => $value) { ?>
								<?php ($value ==  $valueq) ? $selected = ' active' : $selected=''; ?>
								<label for="<?php echo $id . '-' . $value; ?>"  type="button" class="btn<?php echo $selected; ?>">
									<input type="radio" id="<?php echo $id . '-' . $value; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" <?php if ($valueq == $value) { ?>checked="checked"<?php }?>>
									<?php echo $key; ?>
								</label>
							<?php } ?>
						</div>
					</div>
				</div><hr>  
   
  <div class="row-fluid">
		<div class="span2"><?php echo $text_additional1; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $img_additional1; $name	= 'img_additional1'; $id = 'img_additional1';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	</div><hr>
     <div class="row-fluid">
		<div class="span2"><?php echo $text_additional2; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $img_additional2; $name	= 'img_additional2'; $id = 'img_additional2';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	</div><hr>    

 <div class="row-fluid">
					<div class="span2"><?php echo $text_detail_view; ?></div>
					<div class="span10">
						<?php 
							$ar 	= array( 'Default' =>false , 'Accordeon' =>true ); 
							$valueq 	= $detail_view; $name	= 'detail_view'; $id = 'detail_view';
						?>
						<div class="btn-group" data-toggle="buttons-radio">
							<?php foreach ($ar as $key => $value) { ?>
								<?php ($value ==  $valueq) ? $selected = ' active' : $selected=''; ?>
								<label for="<?php echo $id . '-' . $value; ?>"  type="button" class="btn<?php echo $selected; ?>">
									<input type="radio" id="<?php echo $id . '-' . $value; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" <?php if ($valueq == $value) { ?>checked="checked"<?php }?>>
									<?php echo $key; ?>
								</label>
							<?php } ?>
						</div>
					</div>
				</div><hr>   
                       
<div class="row-fluid">
		<div class="span2"><?php echo $text_wishlist; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $show_wishlist; $name	= 'show_wishlist'; $id = 'show_wishlist';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	</div><hr>
<div class="row-fluid">
		<div class="span2"><?php echo $text_compare; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $show_compare; $name	= 'show_compare'; $id = 'show_compare';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	</div><hr>
    
   
  <div class="row-fluid">
		<div class="span2"><?php echo $text_quickview; ?></div>
		<div class="span10">
          <?php 
			$valueq 	= $quick_view; $name	= 'quick_view'; $id = 'quick_view';
			?>
			<span class="switch">
				<input type="checkbox" id="<?php echo $id; ?>" name="<?php echo $name; ?>" <?php if ($valueq) { ?>checked="checked"<?php }?> value="1">
				<label for="<?php echo $id; ?>" class="switch-img"></label>
			</span>
		</div>
	</div><hr />
    <div class="row-fluid">
					<div class="span2">Search</div>
					<div class="span10">
						<?php 
							$ar 	= array( 'open click' =>false , 'always open' =>true ); 
							$valueq 	= $check_view; $name	= 'check_view'; $id = 'check_view';
						?>
						<div class="btn-group" data-toggle="buttons-radio">
							<?php foreach ($ar as $key => $value) { ?>
								<?php ($value ==  $valueq) ? $selected = ' active' : $selected=''; ?>
								<label for="<?php echo $id . '-' . $value; ?>"  type="button" class="btn<?php echo $selected; ?>">
									<input type="radio" id="<?php echo $id . '-' . $value; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" <?php if ($valueq == $value) { ?>checked="checked"<?php }?>>
									<?php echo $key; ?>
								</label>
							<?php } ?>
						</div>
					</div>
				</div><hr>      
    
</div>