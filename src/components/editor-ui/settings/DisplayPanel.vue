<template>
    <div>
        <el-row>
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">TRIGGER TYPE</label>
                    <el-select v-model="display_configs.trigger_type" clearable placeholder="Select" size="mini">
                        <el-option
                        v-for="item in triggers"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                        </el-option>
                    </el-select>
                </div>
            </el-col>
        </el-row>
        <el-row v-if="display_configs.trigger_type === 'page_load'">
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">TIME ON PAGE DURATION (SECONDS)</label>
                    <el-input type="number" size="mini" v-model="display_configs.display_time"></el-input>
                </div>
            </el-col>
        </el-row>

        <el-row v-if="display_configs.trigger_type === 'on_click'">
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">HTML ELEMENT ID</label>
                    <el-input type="text" size="mini" v-model="display_configs.html_element"></el-input>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
export default {
    props:['display_configs'],
    data() {
        return {
            triggers: [{
                value: 'page_load',
                label: 'Page Load'
                }, {
                value: 'on_click',
                label: 'On Click'
            }],
        }
    }
}
</script>