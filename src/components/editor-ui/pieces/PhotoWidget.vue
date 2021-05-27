<template>
    <div class="ninja-upload-photo-element" v-if="app_ready">
        <div class="ninja-upload-container">
            <div class="upload-items">
                <div class="ninja_popup_photo_holder_element" :class="[modelValue ? 'ninja_upload_photo_container' : '']">
                    <img v-if="modelValue" :src="modelValue"/>
                </div>
                <i class="el-icon-upload ninja-upload-icon"></i>
                <p>Browse for a file to upload</p>
                <el-button size="small" @click="initUploader" :type="btn_type">{{btn_text}}</el-button>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
    .ninja-upload-photo-element{
        .ninja-upload-container{
            display: flex;
            .upload-items{
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                .ninja_upload_photo_container{
                    margin-bottom:15px;
                }
                .ninja-upload-icon{
                    font-size: 35px;
                }
                .ninja_popup_photo_holder_element{
                    img{
                        display: block;
                        max-height: 100px;
                        height: 80px;
                        width:80px;
                    }
                }
            }
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