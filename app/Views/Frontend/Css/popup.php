
.fizzy-popup-content-styler{
    background-color: <?php echo esc_html($popup_meta['layout']['background_color']); ?> !important; 
    <?php if($popup_meta['layout']['corners'] === 'rounded'): ?>
    border-radius: 8px;
    <?php endif; ?>
    <?php if(!empty($popup_meta['layout']['background_image_url'])): ?>
    background-image:url(<?php echo esc_url($popup_meta['layout']['background_image_url']); ?>);
    <?php endif; ?>
};