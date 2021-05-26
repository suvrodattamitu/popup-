<template>
    <div class="ninja-popup-button-container">
        <div :class="`ninja-button-component ${configs.selector}`">
            <a href="" target="_blank">
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