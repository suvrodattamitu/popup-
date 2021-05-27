<template>
    <div class="ninja_countdown_wrapper">
        <div class="ninja_countdown_editor">
            <div class="wpp_section_header">
                <div class="wpp_section_title">
                    <div class="ninja_header_show" v-if="!title_editing">
                        <i style="cursor: pointer" @click="title_editing = true" class="el-icon-edit">{{popup_details.post_title}}</i>
                    </div>
                    <div v-else class="ninja_header_editing">
                        <el-input placeholder="Table Name" size="mini" v-model="popup_details.post_title"></el-input>
                        <el-button type="success" size="mini" @click="updatePopupTitle">Save</el-button>
                    </div>
                </div>

                <div class="wpp_section_logo">
                    <div class="wpp_upgrade_logo">
                        <code class="copy"
                            :data-clipboard-text='`[ninja_popup_layout id="${popup_details.ID}"]`'>
                            <i class="el-icon-document"></i> [ninja_popup_layout id="{{ popup_details.ID }}"]
                        </code>
                    </div>
                </div>
                
                <div class="wpp_section_actions">
                    <el-button size="mini" type="primary" @click="updateConfigs">
                        Update
                    </el-button>
                </div>
            </div>
            
            <div class="ninja_editor_body" v-loading="loading">
                <div class="ninja_countdown_preview" v-if="popup_meta">
                    <popup-area :popup_meta="popup_meta"></popup-area>
                </div>
                <div class="ninja_countdown_settings" v-if="popup_meta">
                    <div class="settings_panel">
                        <el-tabs type="border-card">
                            <el-tab-pane>
                                <template #label>
                                    <span class="icon-style"><i class="el-icon-date"></i>Contents</span>
                                </template>
                                <contents-panel :popup_meta="popup_meta"></contents-panel>
                            </el-tab-pane>
                            <el-tab-pane>
                                <template #label>
                                    <span class="icon-style"><i class="el-icon-date"></i>Layout</span>
                                </template>
                                <layout-panel :layout_configs="popup_meta.layout"></layout-panel>
                            </el-tab-pane>
                            <el-tab-pane>
                                <template #label>
                                    <span class="icon-style"><i class="el-icon-date"></i>Display</span>
                                </template>
                                <display-panel :display_configs="popup_meta.settings"></display-panel>
                            </el-tab-pane>
                        </el-tabs>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
import PopupArea from '../components/editor-ui/popup/PopupArea';
import ContentsPanel from '../components/editor-ui/settings/ContentsPanel';
import LayoutPanel from '../components/editor-ui/settings/LayoutPanel';
import DisplayPanel from '../components/editor-ui/settings/DisplayPanel';
import Remove from '../components/editor-ui/pieces/Remove';

export default {
    name:'popup-editor',
    
    components:{
        PopupArea,
        ContentsPanel,
        LayoutPanel,
        DisplayPanel,
        Remove
    },

    data() {
        return {
            val:'',
            val1:'',
            activeName: "1",
            popup_meta: false,
            loading: false,
            title_editing: false,
            popup_details:false,
            popup_id: this.$route.params.popup_id
        }
    },

    methods: {
        updateConfigs() {
            this.loading = true
            this.$adminPost({
                route: 'update_popup_meta',
                popup_id: this.popup_id,
                popup_meta: JSON.stringify(this.popup_meta)
            })
                .then(response => {
                    if( response.data ) {
                        this.$message({
                            showClose: true,
                            message: response.data.message,
                            type: 'success'
                        });
                        this.getConfigs();
                    }
                }).fail(error => {

                }).always(() => {
                    this.loading = false
                });
        },

        getConfigs() {
            this.loading = true
            this.$adminGet({
                route: 'get_popup_meta',
                popup_id: this.$route.params.popup_id
            })
                .then(response => {
                    if( response.data ) {
                        this.popup_meta = response.data.popup_meta;
                        this.popup_details = response.data.popup_details;
                        window.mitt.emit('update_css');
                    }
                }).fail(error => {
                    
                }).always(() => {
                    this.loading = false
                });
        },
        
        updatePopupTitle(){
            if (this.popup_details && !this.popup_details.post_title) {
                this.$message({
                    showClose: true,
                    message: 'Please Provide Popup Title',
                    type: 'error'
                });
                return;
            }
            this.loading = true
            this.$adminPost({
                route: 'update_popup_title',
                popup_id: this.popup_id,
                popup_title: this.popup_details.post_title
            })
                .then(response => {
                    if( response.data ) {
                        this.$message({
                            showClose: true,
                            message: response.data.message,
                            type: 'success'
                        });
                        this.title_editing = false;
                    }
                }).fail(error => {

                }).always(() => {
                    this.loading = false
                });
        },

        //css generate start 
        generateCSS(prefix) {
            let popup_meta = this.popup_meta;

            let css = `.ninja-popup-banner-container{
                flex-basis: 0px;
                flex-grow: 1;
                min-width: 0px;
                position: relative;
            }`;

            css += `.ninja-popup-banner-container .ninja-banner-component{
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
            }`;

            css += `.ninja-popup-modal .ninja-popup-content-styler{
               background-color: ${popup_meta.layout.background_color}; 
            }`;

            popup_meta.popup_components.forEach(element => {
                //title
                if( element.key === 'title' ) {
                    css += `${prefix} .${element.selector}{
                        text-align: center;
                        color: ${element.text_color};
                        font-size: ${element.text_size}px;
                        font-weight: ${element.text_weight};
                        line-height: 1.1;
                    }`
                }

                //button
                if( element.key === 'button' ) {
                    css += `.ninja-popup-button-container{
                        display: flex;
                        justify-content: center;
                    }`;
                    css += `.ninja-popup-button-container .ninja-button-component{
                        display: inline-flex;
                        overflow: hidden;
                        box-sizing: border-box;
                        justify-content: center;
                        align-items: center;
                        padding: 0 12px;
                        outline: none;
                        white-space: nowrap;
                        text-overflow: ellipsis;
                        font-weight: 700;
                        line-height: 1;
                        transition-property: border-color, background-color, color;
                        transition-duration: 0.2s;
                        transition-timing-function: ease;
                    }`;
                    css += `${prefix} .${element.selector}{
                        height: 48px;
                        font-size: ${element.size}px;
                        background-color: ${element.background_color};
                        font-weight: 700;
                        width: ${element.width}px;
                    }`

                    css += `${prefix} .${element.selector} a{
                        color: ${element.text_color};
                    }`
                }

                //spacing
                if( element.key === 'spacing' ) {
                    css += `${prefix} .${element.selector}{
                        height: ${element.size}px;
                    }`
                }

                //image
                if( element.key === 'image' ) {
                    css += `${prefix} .${element.selector} img{
                        width: ${element.scale}%;
                    }`
                }

                //separator
                if( element.key === 'separator' ) {
                    css += `.ninja-separator-container {
                        padding: ${element.margin}px 0px;
                    }`

                    css += `.ninja-separator-component::before {
                        display: block;
                        border-top-width: 3px;
                        border-top-style: solid;
                        content: '';
                        border-top-color: ${element.color};
                    }`
                }
            });

            return css;
        },

        reloadCss() {
            let classPrefix = '.ninja-popup-components-container';
            let popupCss = this.generateCSS(classPrefix);
            jQuery('#ninja_popup_dynamic_style').html(popupCss);  
        }
        //css generate end
    },

    mounted() {
        this.getConfigs();
        window.mitt.on('update_css', () => {
            if (this.popup_meta) {
                this.reloadCss();
            }
        });
    }
}
</script>