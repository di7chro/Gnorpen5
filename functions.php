<?php
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array('name'=>'Sidebar 1',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget' => '</div><!-- END SIDEBAR-WIDGET -->',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array('id'=>'Sidebar 2',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget' => '</div><!-- END SIDEBAR-WIDGET -->',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
		register_sidebar(array('name'=>'Sidebar Head',
		'before_widget' => '<div class="head-widget">',
		'after_widget' => '</div><!-- END HEAD-WIDGET -->',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array('name'=>'Sidebar Footer 1',
		'before_widget' => '<div class="footer-widget">',
		'after_widget' => '</div><!-- END FOOTER-WIDGET -->',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
		register_sidebar(array('name'=>'Sidebar Footer 2',
		'before_widget' => '<div class="footer-widget">',
		'after_widget' => '</div><!-- END FOOTER-WIDGET -->',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array('name'=>'Sidebar Footer 3',
		'before_widget' => '<div class="footer-widget">',
		'after_widget' => '</div><!-- END FOOTER-WIDGET -->',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
		register_sidebar(array('name'=>'Sidebar Footer 4',
		'before_widget' => '<div class="footer-widget">',
		'after_widget' => '</div><!-- END FOOTER-WIDGET -->',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}
	
/**
 * Determines the difference between two timestamps.
 *
 * The difference is returned in a human readable format such as "1 hour",
 * "5 mins", "2 days".
 *
 * @since 1.5.0
 *
 * @param int $from Unix timestamp from which the difference begins.
 * @param int $to Optional. Unix timestamp to end the time difference. Default becomes time() if not set.
 * @return string Human readable time difference.
 */
function gnorpen_human_time_diff( $from, $to = '' ) {
	if ( empty($to) )
		$to = time();
	$diff = (int) abs($to - $from);
	if ($diff <= 3600) {
		$mins = round($diff / 60);
		if ($mins <= 1) {
			$mins = 1;
		}
		/* translators: min=minute */
		$since = sprintf(_n('%s minut', '%s minuter', $mins), $mins);
	} else if (($diff <= 86400) && ($diff > 3600)) {
		$hours = round($diff / 3600);
		if ($hours <= 1) {
			$hours = 1;
		}
		$since = sprintf(_n('%s timme', '%s timmar', $hours), $hours);
	} elseif ($diff >= 86400) {
		$days = round($diff / 86400);
		if ($days <= 1) {
			$days = 1;
		}
		$since = sprintf(_n('%s dag', '%s dagar', $days), $days);
	}
	return $since;
}

/* Gnorpen kommentarer */
function gnorpen_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li>
	<div class="kommentar">
		<div class="kommentar_bild">
			<?php if (function_exists('userphoto_comment_author_thumbnail')) {  userphoto_comment_author_thumbnail();}?>
		</div> <!-- END KOMMENTAR_BILD -->
		<div class="kommentar_text">
			<?php echo "<b>" . get_comment_author() . ": </b> "?>
			<?php comment_text(); ?>
		</div><!-- END KOMMENTAR_TEXT -->
		<div class="kommentar_meta"> 
			<?php echo gnorpen_human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' sedan'; edit_comment_link(__('(Edit)'),' ','') ?>
		</div> <!-- END KOMMENTAR_META -->
	</div> <!-- END KOMMENTAR -->
<?php
}

function gnorpen_comment_form( $args = array(), $post_id = null ) {
	global $id;

	if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;

	if (is_user_logged_in() ) {
		echo "<form action='" . site_url( '/wp-comments-post.php' ) . "' method=\"post\" class=\"kommentars_formular\">";
		do_action( 'comment_form_before_fields' );
		foreach ( (array) $args['fields'] as $name => $field ) {
			echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
		}
		echo "<textarea class='kommentars_ruta' name='comment' aria-required='true' onFocus='empty_comment(this);'>Skriv dina kommentarer</textarea>";
		echo "<p class='form-submit'>";
		echo "<input name='submit' type='submit' class='submit' value='Kommentera' />";
		comment_id_fields( $post_id );
		echo "</p>";
		do_action( 'comment_form', $post_id );
		echo "</form>";
	}
	else {
		echo "<p class='must-log-in'>";
			echo "Du m&aring;ste vara <a href=\"http://gnorpen.com/wp-admin/\">inloggad</a> f&ouml;r att kommentera.";
		echo "</p>";
	}
}


/*   
 * Födelsedagspluggen
 * http://justintadlock.com/archives/2009/09/10/adding-and-using-custom-user-profile-fields
*/
add_action( 'show_user_profile', 'gnorpen_birthday' );
add_action( 'edit_user_profile', 'gnorpen_birthday' );

function gnorpen_birthday( $user ) {  ?>
	<h3>Födelsedag</h3>
	<table class="form-table">
		<tr>
			<th><label for="fodelsedag">När är du född?</label></th>
			<td>
				<input type="text" name="fodelsedag" id="fodelsedag" value="<?php echo esc_attr( get_the_author_meta( 'fodelsedag', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Skriv din födelsedag (MM-DD)</span>
			</td>
		</tr>
	</table>
<?php 
}
add_action( 'personal_options_update', 'gnorpen_save_birthday' );
add_action( 'edit_user_profile_update', 'gnorpen_save_birthday' );

function gnorpen_save_birthday( $user_id ) {
	global $wpdb;
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'the ID' to the field ID. */
	update_usermeta( $user_id, 'fodelsedag', $_POST['fodelsedag'] );
	$datum = date ("Y") . "-" . $_POST['fodelsedag'];
	global $current_user;
	get_currentuserinfo();
	
	$sql = "INSERT INTO gnrp3_eventscalendar_main " . 
			 "(eventTitle, eventStartDate, eventStartTime, eventEndDate, eventEndTime, accessLevel) " . 
			 "VALUES ".
			 "('{$current_user->display_name} fyller &aring;r idag!', '{$datum}', '00:01:00', '{$datum}', '23:59:00', 'public');";
	$wpdb->query($sql);
}

?>
