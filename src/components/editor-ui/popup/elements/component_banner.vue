<template>
    <div class="fizzy-popup-banner-container" v-if="configs.show === 'true'">
        <div :class="`fizzy-banner-component ${configs.selector}`" :style="`background-image:url(${configs.background_image_url})`">
        </div>
    </div>
</template>

<script>
export default {
    props:['configs']
}
</script>