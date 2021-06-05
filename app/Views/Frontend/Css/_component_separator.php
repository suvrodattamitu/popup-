.fizzy-separator-container {
    padding: <?php echo esc_html($element['margin']);?>px 0px;
}

.fizzy-separator-component::before {
    display: block;
    border-top-width: 3px;
    border-top-style: solid;
    content: '';
    border-top-color: <?php echo esc_html($element['color']); ?>;
}