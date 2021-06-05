<template>
    <div>
        <!-- here we will register dynamic settings according to popup meta -->
        <el-row>
            <el-col>
                <el-collapse v-model="activeName" accordion>
                    <draggable  :list="popup_meta.popup_components" :component-data="getComponentData()" item-key="name">
                        <template #item="{element, index}">
                            <div class="fizzy-collapse-item">
                                <div class="item-reorder">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 7 14" focusable="false">
                                        <path d="M1,4c0.6,0,1,0.4,1,1S1.6,6,1,6S0,5.6,0,5S0.4,4,1,4L1,4z"></path>
                                        <path d="M1,0c0.6,0,1,0.4,1,1S1.6,2,1,2S0,1.6,0,1S0.4,0,1,0L1,0z"></path>
                                        <path d="M1,8c0.6,0,1,0.4,1,1s-0.4,1-1,1S0,9.6,0,9S0.4,8,1,8L1,8z"></path>
                                        <path d="M1,12c0.6,0,1,0.4,1,1s-0.4,1-1,1s-1-0.4-1-1S0.4,12,1,12L1,12z"></path>
                                        <path d="M6,0c0.6,0,1,0.4,1,1S6.6,2,6,2S5,1.6,5,1S5.4,0,6,0L6,0z"></path>
                                        <path d="M6,4c0.6,0,1,0.4,1,1S6.6,6,6,6S5,5.6,5,5S5.4,4,6,4L6,4z"></path>
                                        <path d="M6,8c0.6,0,1,0.4,1,1s-0.4,1-1,1S5,9.6,5,9S5.4,8,6,8L6,8z"></path>
                                        <path d="M6,12c0.6,0,1,0.4,1,1s-0.4,1-1,1s-1-0.4-1-1S5.4,12,6,12L6,12z"></path>
                                    </svg>
                                </div>
                                <el-collapse-item :title="ucfirst(element.key)" :name="index">
                                    <component 
                                        v-bind:is="'component_'+element.key"
                                        :configs="element"
                                    ></component>
                                </el-collapse-item>
                            </div>
                        </template>
                    </draggable>
                </el-collapse>
            </el-col>
        </el-row>
    </div>
</template>

<style lang="scss" scoped>
    .fizzy-collapse-item{
        .item-reorder{
            vertical-align: middle;
            display: table-cell;
            width: 7px;
            border: none;
            outline: 0;
            // padding: 8px 16px 8px 7px;
            float: left;
            margin-top: 16px;
            cursor: move;
            outline: none;
            svg{
                display: inline-block;
                // width: 7px;
                //height: 14px;
                fill: #fff;
                transition: all 0.2s ease;
            }
        }
    }
</style>

<script>
import component_button from './elements/component_button';
import component_image from './elements/component_image';
import component_spacing from './elements/component_spacing';
import component_title from './elements/component_title';
import component_separator from './elements/component_separator';
import component_banner from './elements/component_banner';
import draggable from 'vuedraggable';

export default {
    props:['popup_meta'],
    components: {
        component_button,
        component_image,
        component_spacing,
        component_title,
        component_separator,
        component_banner,
        draggable,
    },
    data() {
        return {
            val:'',
            value2:"true",
            activeName: 0
        }
    },

    methods:{
        getComponentData() {
            return {
                onChange: this.handleChange,
                onInput: this.inputChanged,
                wrap: true,
                value: [1],
            };
        },
        handleChange() {
            
        },
        inputChanged(value) {
           
        },
        ucfirst(str) {
            if (typeof str !== 'string') return ''
            return str.charAt(0).toUpperCase() + str.slice(1)
        }
    },

    watch: {
        'popup_meta.popup_components': {
            handler(val){
                window.mitt.emit('update_css')
            },
            deep: true
        }
    }
}
</script>