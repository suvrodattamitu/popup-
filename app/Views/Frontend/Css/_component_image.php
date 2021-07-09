<?php 
    if( empty($element['image_url']) ) {
        return;
    }
?>
.<?php echo $prefix; ?> .<?php echo $element['selector']; ?> img{
    width: <?php echo $element['scale']; ?>%;
}
                