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
                    <label class="fizzy_popup_label">TITLE</label>
                    <el-input v-model="configs.value" size="mini"></el-input>
                </div>
            </el-col>
        </el-row>
        <el-row v-if="configs.show === 'true'">
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">COLOR</label>
                    <color-picker v-model="configs.text_color"></color-picker>
                </div>
            </el-col>
        </el-row>
        <el-row v-if="configs.show === 'true'">
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">FONT SIZE, (in px)</label>
                    <el-slider v-model="configs.text_size" :min="10" :max="100"></el-slider>
                </div>
            </el-col>
        </el-row>
        <el-row v-if="configs.show === 'true'">
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">FONT WEIGHT</label>
                    <el-select v-model="configs.text_weight" clearable placeholder="Select" size="mini">
                        <el-option
                        v-for="item in font_sizes"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                        </el-option>
                    </el-select>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
import ColorPicker from '../../pieces/ColorPicker.vue';

export default {
    props:['configs'],
    data() {
        return {
            font_sizes: [{
                value: 'regular',
                label: 'Regular'
                }, {
                value: 'bold',
                label: 'Bold'
            }],
        }
    },
    components: {
        ColorPicker
    }
}
</script>