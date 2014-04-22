<?php if(!isset($_REQUEST["um_ajax_load_site"])): ?>
</div> <!-- main_container END -->

	<footer>
		<?php the_field('footer_content','options'); ?>
		<?php $f_networks = get_field('social_networks','options'); ?>
		<?php if($f_networks):?>
			<ul class="socialIcons">
				<?php foreach($f_networks as $network):?>
					<li><a href="<?php echo $network['network_url']; ?>"><i class="fa <?php echo $network['network']; ?>"></i></a></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</footer>
</div> <!-- um_container END -->
<?php wp_footer(); ?>
</body>
</html>  
<?php endif;?>