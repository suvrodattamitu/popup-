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
                    <label class="fizzy_popup_label">BUTTON TEXT</label>
                    <el-input v-model="configs.text" size="mini"></el-input>
                </div>
            </el-col>
        </el-row>
         <el-row v-if="configs.show === 'true'">
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">BUTTON URL</label>
                    <el-input v-model="configs.btn_url" size="mini"></el-input>
                </div>
            </el-col>
        </el-row>
        <el-row v-if="configs.show === 'true'">
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">WIDTH (in px)</label>
                    <el-slider v-model="configs.width" :min="250" :max="750"></el-slider>
                </div>
            </el-col>
        </el-row>
        <el-row v-if="configs.show === 'true'">
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">BUTTON COLOR</label>
                    <color-picker v-model="configs.background_color"></color-picker>
                </div>
            </el-col>
        </el-row>
        <el-row v-if="configs.show === 'true'">
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">BUTTON TEXT COLOR</label>
                    <color-picker v-model="configs.text_color"></color-picker>
                </div>
            </el-col>
        </el-row>
        <el-row v-if="configs.show === 'true'">
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">FONT SIZE (in px)</label>
                    <el-slider v-model="configs.size" :min="10" :max="100"></el-slider>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
import ColorPicker from '../../pieces/ColorPicker.vue';

export default {
    props:['configs'],
    components: {
        ColorPicker
    }
}
</script>