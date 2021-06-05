<template>
    <div>
        <el-row>
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">TITLE</label>
                    <el-input v-model="configs.value" size="mini"></el-input>
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
                            v-model="configs.text_color" 
                            show-alpha>
                        </el-color-picker>
                    </div>
                </div>
            </el-col>
        </el-row>
        <el-row>
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">FONT SIZE, (in px)</label>
                    <el-slider v-model="configs.text_size" :min="10" :max="100"></el-slider>
                </div>
            </el-col>
        </el-row>
        <el-row>
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
    }
}
</script>