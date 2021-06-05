<template>
    <div>
        <el-row>
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">TIME ON PAGE DURATION (SECONDS)</label>
                    <el-input type="number" size="mini" v-model="display_configs.display_time"></el-input>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
export default {
    props:['display_configs']
}
</script>