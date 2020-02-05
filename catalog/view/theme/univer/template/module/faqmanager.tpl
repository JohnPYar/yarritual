<div class="section box">
<?php if ($module_title){ ?>
<div class="box-heading"><?php echo $module_title; ?></div>
<?php } ?>
<?php foreach($sections as $section){ ?>
<div class="faq-single">
<div class="faq-heading <?php echo $module; ?>"><?php echo $section['title']; ?></div> 
<div class="faq-answer"><?php echo $section['description']; ?></div>
</div>
<?php } ?>
</div>

<script type="text/javascript">
$(document).ready(function(){
$('.hidden').next().remove();
$('.hidden').remove();
$(".faq-heading.<?php echo $module; ?>").click(function() {
$(this).toggleClass("active");
$(this).next(".faq-answer").slideToggle( 400, function() {
// Animation complete.
}); }); });
</script>

