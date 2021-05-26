<template>
    <div class="ninja-separator-container">
        <div :class="`ninja-separator-component ${configs.selector}`"></div>
    </div>
</template>

<script>
export default {
    props:['configs']
}
</script>