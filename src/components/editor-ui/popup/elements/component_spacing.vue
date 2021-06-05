<template>
    <div :class="`fizzy-spacing-component ${configs.selector}`"></div>
</template>

<script>
export default {
    props:['configs']
}
</script>