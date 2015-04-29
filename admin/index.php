<?php
/*.................................................................................................................
...................................................................................................................
@@@@@@@@@@@@@@@@@@@@@	Plugin Setting Page 	@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
...................................................................................................................
..................................................................................................................*/

// create custom plugin settings menu
add_action('admin_menu', 'endlessScroll_create_menu');

function endlessScroll_create_menu() {

	//create new top-level menu
	add_menu_page('endlessScroll Plugin Settings', 'endlessScroll Settings', 'administrator', __FILE__, 'endlessScroll_settings_page');

	//call register settings function
	add_action( 'admin_init', 'register_endlessScroll' );
}


function register_endlessScroll() {
	//register our settings

    //$vScroll = $_POST['vScroll'];
	register_setting( 'endlessScroll-settings-group', 'vScroll');
	register_setting( 'endlessScroll-settings-group', 'hScroll' );
	register_setting( 'endlessScroll-settings-group', 'showOnHover' );
	register_setting( 'endlessScroll-settings-group', 'zindex' );
	register_setting( 'endlessScroll-settings-group', 'easingDuration' );

	register_setting( 'endlessScroll-settings-group', 'trackWidth' );
	register_setting( 'endlessScroll-settings-group', 'trackColor' );
	register_setting( 'endlessScroll-settings-group', 'barWidth' );
	register_setting( 'endlessScroll-settings-group', 'barColor' );
}


function endlessScroll_settings_page() {
?>
<div class="wrap">
<h2>endless Scroll Settings</h2><hr>

<h3>General Settings</h3>
<form method="post" action="options.php">
    <?php settings_fields( 'endlessScroll-settings-group' ); ?>
    <?php do_settings_sections( 'endlessScroll-settings-group' ); ?>
    <table class="form-table">
    	<tr valign="top">
        <th scope="row">Vertical Scrolling</th>
        <?php $vs = esc_attr(get_option('vScroll')); ?>
        <td>
            <select name='vScroll'>
                <option value='true' <?php if($vs=='true') : echo 'selected'; endif; ?>>Enable</option>
                <option value='false' <?php if($vs=='false') : echo 'selected'; endif; ?>>Disable</option>
            </select>
        </td>
        <?php
            
        ?>
        </tr>

        <tr valign="top">
            <th scope="row">Horizontal Scrolling</th>
            <?php $hs = esc_attr(get_option('hScroll')); ?>
            <td>
                <select name='hScroll'>
                    <option value='true' <?php if($hs=='true') : echo 'selected'; endif; ?>>Enable</option>
                    <option value='false' <?php if($hs=='false') : echo 'selected'; endif; ?>>Disable</option>
                </select>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Show On Hover</th>
            <?php $sh = esc_attr(get_option('showOnHover')); ?>
            <td>
                <select name='showOnHover'>
                    <option value='true' <?php if($sh=='true') : echo 'selected'; endif; ?>>Enable</option>
                    <option value='false' <?php if($sh=='false') : echo 'selected'; endif; ?>>Disable</option>
                </select>
            </td>
        </tr>
         
        <tr valign="top">
            <th scope="row">z-Index</th>
            <?php $zi = intval(esc_attr(get_option('zindex'))); ?>
            <td>
                <input type="text" name="zindex" value="<?php if($zi == '') : echo '100'; else: echo $zi; endif; ?>" />
            </td>
        </tr>
        
        <tr valign="top">
            <th scope="row">Easing Duration</th>
            <?php $ed = intval(esc_attr(get_option('easingDuration'))); ?>
            <td>
                <input type="text" name="easingDuration" value="<?php if($ed == '') : echo '500'; else: echo $ed; endif; ?>" />
                <p class="description">Insert easing time as mili-second. eg: 1000 for 1 sec.</p>
            </td>
        </tr>
    </table>
<hr>
 <h3>Other Settings</h3>  
	<table class="form-table">

        <tr valign="top">
            <th scope="row">Scroll Track Width</th>
            <?php $tw = intval(esc_attr(get_option('trackWidth'))); ?>
            <td>
                <input type="text" name="trackWidth" value="<?php if($tw == '') : echo '6'; else: echo $tw; endif; ?>" /> &nbsp; px
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Scroll Track Color</th>
            <?php $tc = esc_attr(get_option('trackColor')); ?>
            <td>
                <input type="text" name="trackColor" value="<?php if($tc == '') : echo 'aaa'; else: echo $tc; endif; ?>" />
                <p class="description">Please use hexa-decimal color code without '#' sign. eg: ffffff . For more color <a href="http://www.w3schools.com/tags/ref_colorpicker.asp">visit Here.</a></p>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Scroll Bar Width</th>
            <?php $bw = intval(get_option('barWidth')); ?>
            <td>
                <input type="text" name="barWidth" value="<?php if($bw == '') : echo '3'; else: echo $bw; endif; ?>" /> &nbsp; px
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Scroll Bar Color</th>
            <?php $bc = esc_attr(get_option('barColor')); ?>
            <td>
                <input type="text" name="barColor" value="<?php if($bc == '') : echo 'c9c9c9'; else: echo $bc; endif; ?>" />
                <p class="description">Please use hexa-decimal color code without '#' sign. eg: ffffff . For more color <a href="http://www.w3schools.com/tags/ref_colorpicker.asp">visit Here.</a></p>
            </td>
        </tr>

    </table>

    <?php submit_button(); ?>

</form>
</div>
<?php } 


//Activate endlessScroll
function endlessScroll_activate() {
	echo "
		<script>
			jQuery(document).ready(function($) {
			    $('.scrollbox').enscroll({
			    	verticalScrolling: ".get_option('vScroll').",
			    	horizontalScrolling: ".get_option('hScroll').",
			    	showOnHover: ".get_option('showOnHover').",
			    	zIndex: ".get_option('zindex').",
			    	easingDuration: ".get_option('easingDuration')."
			    });
			});
		</script>
	";

	echo "
		<style>
		    .vertical-track {
		        width: ".get_option('trackWidth')."px; 
		        background-color:  #".get_option('trackColor')."; 
		    }
		    .vertical-handle {
		        width:  ".get_option('barWidth')."px; 
		        background-color:  #".get_option('barColor').";
		    }
		</style>

	";
}
add_action('wp_head','endlessScroll_activate');

