<template>
    <div class="fizzy-image-component-container">
        <div :class="`fizzy-image-component ${configs.selector}`" v-if="configs.image_url">
            <img :src="configs.image_url" alt=""/>
        </div>
    </div>
</template>

<script>
export default {
    props:['configs']
}
</script>