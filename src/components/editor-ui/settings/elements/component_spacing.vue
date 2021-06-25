<template>
    <div>
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
        
        <el-row v-if="configs.show === 'true'">
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">SIZE, (in px)</label>
                    <el-slider v-model="configs.size" :min="1" :max="100"></el-slider>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
export default {
    props:['configs']
}
</script>