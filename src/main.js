import mitt from 'mitt';
window.mitt = window.mitt || new mitt()

window.NinjaPopup.app.mixin({
    
    methods: {
        $adminGet(options) {
            options.action = 'ninja_popup_admin_ajax';
            return window.jQuery.get(window.NinjaPopupAdmin.ajaxurl, options);
        },
    
        $adminPost(options) {
            options.action = 'ninja_popup_admin_ajax';
            return window.jQuery.post(window.NinjaPopupAdmin.ajaxurl, options);
        }
    }

})

window.NinjaPopup.app.mount('#ninjapopup-app')