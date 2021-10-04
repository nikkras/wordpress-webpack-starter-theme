<?php

///////////////////////////////////////////////////////////////////////////////
// VARIOUS TEMPLATE TAGS
///////////////////////////////////////////////////////////////////////////////

// ---------------------------------------------------------------
// ACF MAP
// ---------------------------------------------------------------

function wpnk_contactsMap()
{ ?>
	<?php
	$location = get_field('map');
	if ($location) : ?>
		<div class="contactsMap" data-zoom="16">
			<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
		</div>
	<?php endif; ?>
<?php }
