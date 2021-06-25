<template>
    <div class="fizzy-popup-button-container" v-if="configs.show === 'true'">
        <div :class="`fizzy-button-component ${configs.selector}`">
            <div v-html="configs.html"></div>
        </div>
    </div>
</template>

<script type="text/babel">
export default {
    props:['configs']
}
</script>