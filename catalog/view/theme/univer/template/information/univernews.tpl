
<?php echo $header; ?>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
	<div class="breadcrumb">
	<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
	<?php } ?>
	</div>
	<h1><?php echo $heading_title; ?></h1>
	<?php if(isset($univernews_info)) { ?>
		<div class="content-news">
			<div class="news">
				<?php echo $description; ?>
			</div>
			<div class="addthis">
			<?php if($addthis) { ?>
<!-- AddThis Button BEGIN -->
			<div class="share42init"></div>
			<script type="text/javascript" src="catalog/view/javascript/jquery/share42/share42.js"></script> 
		<!-- AddThis Button END --> 
			<?php } ?>
			</div>
		</div>
		<div class="buttons">
			<div class="right">
				<a onclick="location='<?php echo $univernews; ?>'" class="button"><span><?php echo $button_news; ?></span></a>
				
			</div>
		</div> 
        
	   <?php } elseif (isset($univernews_data)) { ?>
       
		<?php foreach ($univernews_data as $univernews) { ?>
           <div class="news_page">
			
	    	<?php if ($univernews['thumb']) { ?>
			<div class="image">
			<a href="<?php echo $univernews['href']; ?>">
		    <img src="<?php echo $univernews['thumb']; ?>" title="<?php echo $univernews['title']; ?>" alt="<?php echo $univernews['title']; ?>" ></a>
			</div>
            

            
		    <?php } ?>

			<div class="news_description <?php if ($univernews['thumb']) { ?> otstup <?php } ?>">
            
            <div class="datepost"><?php echo $univernews['posted']; ?></div>
            <div class="heading_news_mod"><a href="<?php echo $univernews['href']; ?>"> <?php echo $univernews['title']; ?></a></div>   
            
			<p><?php echo $univernews['description']; ?> .. </p>
			<a href="<?php echo $univernews['href']; ?>" class="readnews"> <?php echo $text_more; ?></a>
			</div>
			</div>
		<?php } ?>
		
<div class="pagination"><?php echo $pagination; ?></div>
	<?php } ?></div>
     <div class="cont_bottom"></div>
	<?php echo $content_bottom; ?>

<?php if ((isset($widthimg)) && (isset($heightimg))) { ?>
 <script type="text/javascript">
 $(document).ready(function() {
	var widthimg1 = <?php echo $widthimg; ?> + 20;
	var heightimg1 = <?php echo $heightimg; ?>;
	
	 <?php if ($this->config->get('gen_responsive') == '1') { ?>
	 enquire.register("only screen and (min-width: 790px)", {
			  match : function() {
		   $('.otstup').css('margin-left',widthimg1);
		    $('.otstup').css('min-height',heightimg1);
			  }
		    }).register("only screen and (max-width: 789px)", {
			  match : function() {
		   $('.otstup').css('margin-left',0);
		    $('.otstup').css('min-height','auto');
			  }
		    }); 

		<?php } else { ?>
	 $('.otstup').css('margin-left',widthimg1);
	  $('.otstup').css('min-height',heightimg1);
	 
	<?php } ?>
	   	   
 });
</script>
<?php } ?>
<?php echo $footer; ?>