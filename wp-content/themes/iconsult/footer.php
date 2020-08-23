<!--
========================
FOOTER
========================
-->
<footer>
  <div class="footer-section">
   <?php 
   iconsult__theme_footer_widget(); 
   iconsult__theme_footer_end();
   ?>
  </div>
</footer>
<?php 
wp_footer(); 
$global_website_presentation = iconsult_website_global_design_control();
if( isset($global_website_presentation) && $global_website_presentation != '' ) { 
	echo '</div>'; 
}
?>
</body>
</html>