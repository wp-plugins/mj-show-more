<?php
/*
Plugin Name: MJ_Show_More
Plugin URI: http://www.mediafire.com/download/77sfnsfd34ypjpa/mj_showmore.zip 
Description: This plugin convert the shortcode [showmore]  into an easy to use expanding content area.  
Author: Meskat Jahan
Author URI: meskatjahan.wordpress.com
*/

function mj_showmore( $atts, $content = null ) {
   extract( shortcode_atts( array(
      
      ), $atts ) );
	STATIC $x = 0; 
	STATIC $y = 0;
	$x++;
	
	if ($y == 0){
		$y++;
	}else if ($y == 1){
		$y=0;
	}
	
	$content = str_replace('[more]', '<div class="mjshowmore" id="showmore_-'.$x.'">', $content);
	$content = str_replace('[/more]', '</div>', $content);
	
	return '<div class="showmore showmore-'.$y.'" id="showmore_ID-'.$x.'" name="showmore_ID-'.$x.'">' . $content . '</div>';
	
}

add_shortcode('showmore', 'mj_showmore');


function lwp_showmore_scripts(){
		wp_enqueue_script('jquery');  
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('.showmore').each(function(){
		var showmoreid = ($(this).attr('id')).replace('showmore_ID-', '');
			$(this).find('a').each(function(){
					$(this).attr('href', '#showmore_-'+showmoreid);				
				$(this).click(function(e){
					e.preventDefault();

					$(this).fadeOut('fast',function(){
						$('#showmore_-'+showmoreid).fadeIn();
					});
				});
			});
	});
});
</script>

<style type="text/css">
.mjshowmore{display:none;}
</style>
<?php 


}





add_action('wp_head', 'mj_showmore_scripts');

?>
