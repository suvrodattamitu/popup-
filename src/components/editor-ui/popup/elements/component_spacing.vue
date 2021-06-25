<template>
    <div :class="`fizzy-spacing-component ${configs.selector}`" v-if="configs.show === 'true'"></div>
</template>

<script>
export default {
    props:['configs']
}
</script>