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
                    <label class="fizzy_popup_label">POSITION</label>
                    <el-select v-model="configs.position" clearable placeholder="Select" size="mini">
                        <el-option
                        v-for="item in banner_positions"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                        </el-option>
                    </el-select>
                </div>
            </el-col>
        </el-row>

        <el-row v-if="configs.show === 'true'">
            <el-col :span="24">
                 <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">BANNER IMAGE</label>
                    <photo-widget
                        btn_type="primary"
                        :btn_text="'Select File'"
                        :btn_mode="true"
                        @changed="updateAvatar"
                        v-model="configs.image_url"
                    />
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
import PhotoWidget from '../../pieces/PhotoWidget';

export default {
    props:['configs'],
    components: {
        PhotoWidget
    },
    data() {
        return {
            banner_positions: [{
                value: 'right',
                label: 'Right'
                }, {
                value: 'left',
                label: 'Left'
                },{
                value: 'top',
                label: 'Top'
                },{
                value: 'bottom',
                label: 'Bottom'
            }],
        }
    },
    methods: {
        updateAvatar(url) {
            
        }
    }
}
</script>