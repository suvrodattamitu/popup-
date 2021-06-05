<template>
    <div>
        <el-row>
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">SIZE, (in px)</label>
                    <el-slider v-model="configs.margin" :min="1" :max="100"></el-slider>
                </div>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">COLOR</label>
                    <div class="color-picker">
                        <el-color-picker
                            size="mini" 
                            v-model="configs.color" 
                            show-alpha>
                        </el-color-picker>
                    </div>
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