<template>
    <div>
        <el-row>
            <el-col :span="24">
                <div class="fizzy_popup_item">
                    <label class="fizzy_popup_label">Shortcode</label>
                    <el-input type="text" v-model="configs.shortcode"></el-input>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script type="text/babel">
export default {
    props:['configs']
}
</script>