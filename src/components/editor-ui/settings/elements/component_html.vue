<template>
    <wp-editor :height="100" v-model="configs.html"/>
</template>

<script type="text/babel">
import WpEditor from '../../pieces/WpEditor';

export default {
    name: 'component_html',
    props:['configs'],
    components: {
        WpEditor
    }
}
</script>