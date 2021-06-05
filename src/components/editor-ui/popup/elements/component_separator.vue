<template>
    <div class="fizzy-separator-container">
        <div :class="`fizzy-separator-component ${configs.selector}`"></div>
    </div>
</template>

<script>
export default {
    props:['configs']
}
</script>