<template>    
    <div class="nfd-container">
        <div class="nfd-row" :class="popup_meta.layout_type" v-if="popup_meta.popup_components">
            <div class="ninja-popup-modal">
                <div class="ninja-popup-modal-content ninja-popup-content-styler" :style="[popup_meta.layout.background_image_url ? `background-image:url(${popup_meta.layout.background_image_url});` : '', popup_meta.layout.corners === 'rounded' ? 'border-radius: 8px;' : '']">
                    <div class="ninja-popup-close-button-container" v-if="popup_meta.layout.display_close_button === 'true'">
                        <div class="ninja-countdown-timer-bar-close ninja-popup-close-button" :style="`color:${popup_meta.layout.close_button_color}`"></div>
                    </div>
                    <div class="ninja-popup-components-wrapper" :class="[(findIdx(popup_meta.popup_components) !== -1 && (popup_meta.popup_components[bannerIndex].position === 'top' || popup_meta.popup_components[bannerIndex].position === 'bottom'))? 'ninja-popup-components-wrapper-column' : '']">
                        <div class="ninja-popup-banner-container" v-if="bannerIndex !== -1 && ( popup_meta.popup_components[bannerIndex].position === 'left' || popup_meta.popup_components[bannerIndex].position === 'top')">
                            <div :class="`ninja-banner-component ${popup_meta.popup_components[bannerIndex].selector}`" :style="`background-image:url(${popup_meta.popup_components[bannerIndex].image_url})`"></div>
                        </div>
                        <div class="ninja-popup-components-container">
                            <div class="ninja-popup-component-container" v-for="(popup_component, index) in popup_meta.popup_components" :key="index">
                                <component 
                                    v-if="popup_component.key !== 'banner'"
                                    :is="'component_'+popup_component.key"
                                    :configs="popup_component"
                                >
                                </component>
                            </div>
                        </div>
                        <div class="ninja-popup-banner-container" v-if="bannerIndex !== -1 && (popup_meta.popup_components[bannerIndex].position === 'right' || popup_meta.popup_components[bannerIndex].position === 'bottom')">
                            <div :class="`ninja-banner-component ${popup_meta.popup_components[bannerIndex].selector}`" :style="`background-image:url(${popup_meta.popup_components[bannerIndex].image_url})`"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import component_button from './elements/component_button';
import component_image from './elements/component_image';
import component_spacing from './elements/component_spacing';
import component_title from './elements/component_title';
import component_separator from './elements/component_separator';
import component_banner from './elements/component_banner';

export default {
    props:['popup_meta'],
    components: {
        component_button,
        component_image,
        component_spacing,
        component_title,
        component_separator,
        component_banner,
    },

    data(){
        return {
            bannerIndex: -1,
        }
    },

    methods:{
        findIdx(components) {
            let index = components.findIndex(element => element.key === 'banner');
            this.bannerIndex = index;
            return index;
        }
    }
}
</script>