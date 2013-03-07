<?php
	$withcomments = 1; // force comments form and comments to show on front page
	get_header(); ?>
	<div id="middle-container">
			<div id="content">
				<!-- This sets the $curauth variable -->
				<?php
					$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
				?>
				<div id="userinfo">
					<div id="userinfo_text">
						<h2>Mer om <?php echo $curauth->first_name . " \"" . $curauth->nickname ."\" " . $curauth->last_name ?></h2>
						<p><?php echo $curauth->user_description; ?></p>
						<strong>E-post: </strong> 
						<?php if (is_user_logged_in() ): ?>
							<a href="mailto:'<?php echo $curauth->user_email; ?>?Subject=Gnorpen-mail"><?php echo $curauth->user_email ?></a> <br />
						<?php else: ?>
								Endast synlig för inloggade användare <br/>
						<?php endif; ?>
						<strong>Hemsida: </strong> <a href="<?php echo $curauth->user_url;?>" target="_blank"><?php echo $curauth->user_url;?></a> <br />
						<strong>Medlem sedan: </strong> <?php echo date("d M Y", strtotime($curauth->user_registered)); ?> <br />
						<?php if (is_user_logged_in() ): ?>						
							<p><a href="<?php echo admin_url( 'user-edit.php?user_id=' . $curauth->ID, 'http' ); ?>">(Editera min profil)</a></p>
						<?php endif; ?>
					</div><!-- END USERINFO_TEXT -->
					<div id="userinfo_bild">
					<?php userphoto($curauth->ID) ?>
						<?php if (function_exists('userphoto_the_author_thumbnail')) {  userphoto_the_author_thumbnail();}?>
					</div><!-- END USERINFO_BILD -->
				</div> <!-- END USERINFO -->
				<div id="user-poster">
					<h2>Senaste posterna av <?php echo $curauth->nickname; ?>:</h2>
					<ul>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<li>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
						<?php the_title(); ?></a> för
						<?php echo gnorpen_human_time_diff( get_the_time('U'), current_time('timestamp') ) ?>  sedan. Postat under <?php the_category(' samt under ');?>
						</li>
					<?php endwhile; else: ?>
						<p><?php _e('Denna n00b har inte skrivit nåt på Gnorpen.'); ?></p>
					<?php endif; ?>
					</ul>
				</div> <!-- END USER-POSTER -->
				
			</div><!-- END CONTENT -->
			<div id="sidebars">
				<div id="sidebar1">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar 1') ) : ?> <?php endif; ?>
				</div><!-- END SIDEBAR1 -->
				<div id="sidebar2">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar 2') ) : ?> <?php endif; ?>
				</div><!-- END SIDEBAR2 -->
			</div><!-- END SIDEBARS -->
		</div><!-- END MIDDLE-CONTAINER -->
		<?php get_footer(); ?>
