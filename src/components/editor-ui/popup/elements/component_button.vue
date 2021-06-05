<template>
    <div class="fizzy-popup-button-container">
        <div :class="`fizzy-button-component ${configs.selector}`">
            <a href="" target="_blank">
                {{ configs.text }}
            </a>
        </div>
    </div>
</template>

<script>
export default {
    props:['configs']
}
</script>