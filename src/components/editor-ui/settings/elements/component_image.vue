<template>
    <div>
        <el-row>
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">SCALE, (in %)</label>
                    <el-slider v-model="configs.scale" :min="10" :max="100"></el-slider>
                </div>
            </el-col>
        </el-row>

        <el-row>
            <el-col :span="24">
                 <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">IMAGE</label>
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

<script type="text/babel">
import PhotoWidget from '../../pieces/PhotoWidget';

export default {
    props:['configs'],
    components: {
        PhotoWidget
    },
    methods: {
        updateAvatar(url) {
            
        }
    }
}
</script>