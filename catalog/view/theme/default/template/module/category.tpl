
<?php foreach ($categories as $category) { ?>
	<?php if ($category['category_id']!=="65") { ?>
		<td><a href="<?php echo $category['href']; ?>" title="<?php echo $category['name']; ?>"><h4><?php echo $category['name']; ?></h4></a></td>
	 <?php } ?>
 <?php } ?>