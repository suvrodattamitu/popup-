<template>
    <div>
        <el-row>
            <el-col :span="24">
                <div class="ninja_popup_item">
                    <label class="ninja_popup_label">WIDTH</label>
                    <el-input type="number" v-model="layout_configs.width" size="mini"></el-input>
                </div>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24">
                <div class="ninja_popup_item">
                    <label class="ninja_popup_label">CORNERS</label>
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
                 <div class="ninja_popup_item">
                    <label class="ninja_popup_label">BACKGROUND IMAGE</label>
                    <photo-widget
                        class="fc_photo_changed"
                        btn_type="default"
                        :btn_text="'+ Photo'"
                        :btn_mode="true"
                        @changed="updateAvatar"
                        v-model="layout_configs.background_image_url"
                    />
                </div>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24">
                <div class="ninja_popup_item">
                    <label class="ninja_popup_label">IMAGE OVERLAY COLOR</label>
                    <div class="color-picker">
                        <el-color-picker
                            size="mini" 
                            v-model="layout_configs.background_image_overlay_color" 
                            show-alpha>
                        </el-color-picker>
                    </div>
                </div>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24">
                <div class="ninja_popup_item">
                    <label class="ninja_popup_label">BACKGROUND COLOR</label>
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
                <div class="ninja_popup_item">
                    <label class="ninja_popup_label">DISPLAY CLOSE BUTTON</label>
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
                <div class="ninja_popup_item">
                    <label class="ninja_popup_label">COLOR</label>
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
    methods: {
        updateAvatar(url) {
            
        }
    }
}
</script>