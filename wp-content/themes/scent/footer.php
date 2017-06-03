<?php
/**
 * The template for displaying the footer.
 *
 * @package Scent
 */

global $theme_scent; ?>

<?php if( !empty($theme_scent['opt-footer-text']) ) { ?>

<footer id="footer">
	<div class="container">
		<?php echo $theme_scent['opt-footer-text']; ?>
	</div>
</footer>

<?php } ?>

<?php wp_footer(); ?>

</body>
</html>
