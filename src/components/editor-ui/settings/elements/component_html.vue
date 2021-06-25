<template>
    <el-row>
        <el-col :span="24">
            <div class="fizzy_popup_item">
                <label class="fizzy_popup_label">DISPLAY</label>
                <el-switch
                v-model="configs.show"
                active-value="true"
                inactive-value="false"
                active-color="#13ce66">
                </el-switch>
            </div>
        </el-col>
    </el-row>
    <wp-editor :height="100" v-model="configs.html" v-if="configs.show === 'true'"/>
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