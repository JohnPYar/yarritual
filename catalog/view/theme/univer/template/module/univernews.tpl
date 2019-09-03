
<?php if ($univernews) { ?>


	<div class="box box-news-modul">
		<?php if($customtitle) { ?>
            <div class="box-heading">
			 <a href="<?php echo $univernewslist; ?>"><?php echo $customtitle; ?></a>
			</div>
        <?php } ?>
       
        
		<div class="box-content">
        
		<?php foreach ($univernews as $univernews_story) { ?>
			<div class="box-news  <?php if($pos_line) { ?>boxline<?php } else { ?>countnews-<?php echo count($univernews); ?><?php } ?>">

				<div>
				 <?php if ($univernews_story['thumb']) { ?>
                <div class="newsimage <?php if($pos_img) { ?>boximg<?php } ?>">
                <a href="<?php echo $univernews_story['href']; ?>" >
               <img  src="<?php echo $univernews_story['thumb']; ?>" alt="<?php echo $univernews_story['title']; ?>">
                </a>
                </div>
                <?php } ?>
                
                <div class="news_description">
                    <div class="datepost"><?php echo $univernews_story['posted']; ?></div>
                    <?php if ($headline) { ?>
					<div class="heading_news_mod"><a href="<?php echo $univernews_story['href']; ?>"><?php echo $univernews_story['title']; ?></a></div>
				    <?php } ?>

				    
                   
                     <p><?php echo $univernews_story['description']; ?></p>
                      <a href="<?php echo $univernews_story['href']; ?>" class="readnews"><?php echo $text_more; ?></a>
                </div>
                </div>
				
                
			</div>
		<?php } ?>
        
		
        
		</div>
	</div>

<?php } ?>