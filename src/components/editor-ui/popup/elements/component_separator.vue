<template>
    <div class="fizzy-separator-container" v-if="configs.show === 'true'">
        <div :class="`fizzy-separator-component ${configs.selector}`"></div>
    </div>
</template>

<script>
export default {
    props:['configs']
}
</script>