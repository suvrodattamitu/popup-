.ninja-popup-button-container{
    display: flex;
    justify-content: center;
}

.ninja-popup-button-container .ninja-button-component{
    display: inline-flex;
    overflow: hidden;
    box-sizing: border-box;
    justify-content: center;
    align-items: center;
    padding: 0 12px;
    outline: none;
    white-space: nowrap;
    text-overflow: ellipsis;
    font-weight: 700;
    line-height: 1;
    transition-property: border-color, background-color, color;
    transition-duration: 0.2s;
    transition-timing-function: ease;
}

.<?php echo $prefix; ?> .<?php echo $element['selector']; ?>{
    height: 48px;
    font-size: <?php echo $element['size'] ?>px;
    background-color: <?php echo $element['background_color']; ?>;
    font-weight: 700;
    width: <?php echo $element['width']; ?>px;
}

.<?php echo $prefix; ?> .<?php echo $element['selector']; ?> a{
    color: <?php echo $element['text_color']; ?>;
}