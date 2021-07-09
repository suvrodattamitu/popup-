<?php 
    if( empty($element['image_url']) ) {
        return;
    }
?>

.fizzy-popup-banner-container{
    flex-basis: 0px;
    flex-grow: 1;
    min-width: 0px;
    position: relative;
}

.fizzy-popup-banner-container .fizzy-banner-component{
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}