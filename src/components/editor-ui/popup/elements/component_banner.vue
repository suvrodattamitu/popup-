<template>
    <div class="ninja-popup-banner-container">
        <div :class="`ninja-banner-component ${configs.selector}`" :style="`background-image:url(${configs.background_image_url})`">
        </div>
    </div>
</template>

<script>
export default {
    props:['configs']
}
</script>