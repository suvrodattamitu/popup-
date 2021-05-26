<template>
    <div class="ninja-image-component-container">
        <div :class="`ninja-image-component ${configs.selector}`" v-if="configs.image_url">
            <img :src="configs.image_url" alt=""/>
        </div>
    </div>
</template>

<script>
export default {
    props:['configs']
}
</script>