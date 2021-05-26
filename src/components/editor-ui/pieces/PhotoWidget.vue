<template>
    <div class="fluentcrm_photo_card" v-if="app_ready">
        <div class="fluentcrm_photo_holder">
            <img v-if="modelValue" :src="modelValue"/>
        </div>
        <div :class="[modelValue ? 'ninja_button_container' : '']" >
            <el-button size="small" @click="initUploader" :type="btn_type">{{btn_text}}</el-button>
        </div>
    </div>
</template>

<style lang="scss">
    .fluentcrm_photo_card{
        .fluentcrm_photo_holder{
            img{
                display: block;
                max-height: 100px;
                height: 80px;
                width:80px;
            }
        }
        .ninja_button_container {
            margin-top:15px;
        }
    }
</style>

<script type="text/babel">
    export default {
        name: 'photo_widget',
        emits: ['input','changed','update:modelValue'],
        props: {
            modelValue: {
                required: false,
                type: String
            },
            btn_mode: {
                type: Boolean,
                default() {
                    return false
                }
            },
            btn_text: {
                required: false,
                default() {
                    return '+ Upload';
                }
            },
            btn_type: {
                required: false,
                default() {
                    return 'default';
                }
            }
        },
        data() {
            return {
                app_ready: false,
                image_url: this.modelValue
            }
        },
        methods: {
            initUploader(event) {
                const that = this;
                const sendAttachmentBkp = wp.media.editor.send.attachment;
                wp.media.editor.send.attachment = function (props, attachment) {
                    that.$emit('input', attachment.url);
                    that.$emit('changed', attachment.url);
                    that.$emit('update:modelValue', attachment.url);
                    that.image_url = attachment.url;
                    wp.media.editor.send.attachment = sendAttachmentBkp;
                }
                wp.media.editor.open(jQuery(event.target));
                return false;
            },
            getThumb(attachment) {
                return attachment.url;
            }
        },
        mounted() {
            // console.log('value ', this.value);
            if (!window.wpActiveEditor) {
                window.wpActiveEditor = null;
            }
            this.app_ready = true;
        }
    };
</script>