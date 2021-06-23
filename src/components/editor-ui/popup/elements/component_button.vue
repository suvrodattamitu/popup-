<template>
    <div class="fizzy-popup-button-container" v-if="configs.text">
        <div :class="`fizzy-button-component ${configs.selector}`">
            <a :href="configs.btn_url" target="_blank">
                {{ configs.text }}
            </a>
        </div>
    </div>
</template>

<script>
export default {
    props:['configs']
}
</script>