<div class="cont_bottom"></div>
</div>
</div><!--end main-->       

<div id="footer">
<div class="containermenu">
<div>
  <div class="column">
    <h3><?php echo $text_account; ?></h3>
    <ul>
      <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
      <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
      <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
      <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
    </ul> 
    </div>
  
  
  <?php if ($informations) { ?>
  <div class="column">
    <h3><?php echo $text_information; ?></h3>
    <ul>
      <?php foreach ($informations as $information) { ?>
      <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
      <?php } ?>
      
    </ul>
  </div>
  <?php } ?>
  
 <span class="ctr"></span>
 
   <!--custom block --> 
   <div class="customblock_footer column <?php if ($this->config->get('f_contact_status') !== '1') { ?>width50<?php }?>"> 
    <div>
     <?php if ((isset($this->document->cusom_payment[$this->config->get('config_language_id')]['compfootertext_title'])) && ($this->document->cusom_payment[$this->config->get('config_language_id')]['compfootertext_title']) !=''  ) { ?>
    <h3><?php echo $this->document->cusom_payment[$this->config->get('config_language_id')]['compfootertext_title']; ?></h3>
   <?php }?>
   <?php if(isset($this->document->cusom_payment[$this->config->get('config_language_id')]['footer_payment_text'])) { ?>
    <?php echo  html_entity_decode($this->document->cusom_payment[$this->config->get('config_language_id')]['footer_payment_text']); ?>
   <?php }?>

   </div>
   
   
  </div> 
  <!--end custom block-->  

  <?php if ($this->config->get('f_contact_status') == '1') { ?>
  <div class="column contact">
  <ul>
   <?php if($this->config->get('f_contact_phone') != '') { ?>
      <li class="phone_f"><?php echo html_entity_decode($this->config->get('f_contact_phone'));?></li>
     <?php } ?>
     <?php if($this->config->get('f_contact_fax') != '') { ?>
      <li class="fax_f"><?php echo $this->config->get('f_contact_fax');?></li>
     <?php } ?>
     <?php if($this->config->get('f_contact_email') != '') { ?>
      <li class="email_f"><a href="mailto:<?php echo $this->config->get('f_contact_email')?>"><?php echo $this->config->get('f_contact_email');?></a></li>
     <?php } ?>
     <?php if($this->config->get('f_contact_skype') != '') { ?>
      <li class="skype_f"><a href="skype://<?php echo $this->config->get('f_contact_skype')?>"><?php echo $this->config->get('f_contact_skype');?></a></li>
     <?php } ?>
     <?php if($this->config->get('f_contact_address') != '') { ?>
      <li class="address_f"><?php echo html_entity_decode($this->config->get('f_contact_address'));?></li>
     <?php } ?> 
    </ul>
    
  </div>
  <?php } ?>
  

<div class="extras">
 <?php if(isset($this->document->mattimg_f)) { ?>
   <ul>
    <?php
     $mattimg_f = $this->document->mattimg_f;
      foreach ($mattimg_f as $item) { ?>
      <li><img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" title="<?php echo $item['title']; ?>"></li>
     <?php }?>
   </ul>
   <?php }?>
</div>

  
 
</div>
</div>
</div><!--end footer-->

<!--powered-->
<div id="powered">
<div  class="containermenu">
<div>

 <!--Copyright-->   
 <div class="copyright">
 <?php if($this->config->get('f_contact_copyright') != '') { ?>
      <?php echo html_entity_decode($this->config->get('f_contact_copyright'));?>
     <?php } else { ?>
 <?php echo $powered; ?>
 <?php } ?>
 </div>
 <!--end Copyright--> 
 

 <!--Network icons--> 
    <?php if(isset($this->document->cusom_network)) { ?>
    <div class="soc_network">
 
     <?php
      $cusom_network = $this->document->cusom_network;
      foreach ($cusom_network as $item) { ?>
        <div><a href="<?php echo $item['href']; ?>" style="background-image:url('<?php echo $item['image']; ?>');" title="<?php echo $item['title']; ?>"></a></div>
      <?php }?>

   </div>
   <?php }?>
    <!--end Network icons-->  
        
 <div class="extras">
 <ul> 
       <?php if ($this->config->get('f_link1') == '1') { ?>
      <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
       <?php } ?>
       <?php if ($this->config->get('f_link2') == '1') { ?>
      <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
       <?php } ?>
       <?php if ($this->config->get('f_link3') == '1') { ?>
      <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
       <?php } ?>
       <?php if ($this->config->get('f_link4') == '1') { ?>
      <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
       <?php } ?>
       <?php if ($this->config->get('f_link5') == '1') { ?>
      <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
       <?php } ?>
       <?php if ($this->config->get('f_link6') == '1') { ?>
      <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
       <?php } ?>
       <?php if ($this->config->get('f_link7') == '1') { ?>
      <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
       <?php } ?>
    </ul>
    
     </div> 
     


 <div class="cont_bottom"></div>
 </div>
 </div>
 </div>
<!--end powered--> 

<?php if ($this->config->get('quick_view') == '1') { ?>  
<script type="text/javascript" src="catalog/view/javascript/quickview/quickview.js"></script>		
<link type="text/css"  rel="stylesheet" href="catalog/view/javascript/fancybox/jquery.fancybox.css" />
<script src="catalog/view/javascript/fancybox/jquery.fancybox.pack.js"></script>
 <?php } ?>

 <script type="text/javascript">
$(document).ready(function() {
	$('.select1').customStyle1();
  });
 </script>
</div>
</body></html>