<template>
    <div :class="`ninja-title-component ${configs.selector}`">
        {{ configs.value }} 
    </div>
</template>

<script>
export default {
    props:['configs']
}
</script>