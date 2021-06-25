<template>
    <div :class="`fizzy-title-component ${configs.selector}`" v-if="configs.show === 'true'">
        {{ configs.value }} 
    </div>
</template>

<script>
export default {
    props:['configs']
}
</script>