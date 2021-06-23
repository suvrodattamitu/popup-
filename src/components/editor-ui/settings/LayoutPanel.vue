<template>
    <div>
        <!-- <el-row>
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">WIDTH</label>
                    <el-input type="number" v-model="layout_configs.width" size="mini"></el-input>
                </div>
            </el-col>
        </el-row> -->

        <el-row>
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">MARGIN, (in %)</label>
                    <el-slider v-model="layout_configs.margin" :min="1" :max="50"></el-slider>
                </div>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">CORNERS</label>
                    <el-select v-model="layout_configs.corners" clearable placeholder="Select" size="mini">
                        <el-option
                        v-for="item in corners"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                        </el-option>
                    </el-select>
                </div>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24">
                 <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">BACKGROUND IMAGE</label>
                    <photo-widget
                        btn_type="primary"
                        :btn_text="'Select File'"
                        :btn_mode="true"
                        @changed="updateAvatar"
                        v-model="layout_configs.background_image_url"
                    />
                </div>
            </el-col>
        </el-row>

        <!-- <el-row>
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">IMAGE OVERLAY COLOR</label>
                    <div class="color-picker">
                        <el-color-picker
                            size="mini" 
                            v-model="layout_configs.background_image_overlay_color" 
                            show-alpha>
                        </el-color-picker>
                    </div>
                </div>
            </el-col>
        </el-row> -->

        <el-row>
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">BACKGROUND COLOR</label>
                    <div class="color-picker">
                        <el-color-picker
                            size="mini" 
                            v-model="layout_configs.background_color" 
                            show-alpha>
                        </el-color-picker>
                    </div>
                </div>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">DISPLAY CLOSE BUTTON</label>
                    <el-switch
                    v-model="layout_configs.display_close_button"
                    active-value="true"
                    inactive-value="false"
                    active-color="#13ce66">
                    </el-switch>
                </div>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24" v-if="layout_configs.display_close_button === 'true'">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">CLOSE BUTTON COLOR</label>
                    <div class="color-picker">
                        <el-color-picker
                            size="mini" 
                            v-model="layout_configs.close_button_color" 
                            show-alpha>
                        </el-color-picker>
                    </div>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
import PhotoWidget from '../pieces/PhotoWidget';

export default {
    props:['layout_configs'],
    components: {
        PhotoWidget
    },
    data() {
        return {
            num:1,
            val:'',
            radio:'',
            activeName: "1",
            value1:'',
            corners: [{
                value: 'rounded',
                label: 'Rounded'
                }, {
                value: 'square',
                label: 'Square'
            }],
        }
    },
    watch: {
        'layout_configs.background_color': {
            handler(val){
                window.mitt.emit('update_css')
            },
            deep: true
        }
    },
    methods: {
        updateAvatar(url) {
            
        }
    }
}
</script>