import mitt from 'mitt';
window.mitt = window.mitt || new mitt()

window.NinjaPopups.app.mixin({
    
    methods: {
        $adminGet(options) {
            options.action = 'ninja_popup_admin_ajax';
            return window.jQuery.get(window.NinjaPopupsAdmin.ajaxurl, options);
        },
    
        $adminPost(options) {
            options.action = 'ninja_popup_admin_ajax';
            return window.jQuery.post(window.NinjaPopupsAdmin.ajaxurl, options);
        }
    }

})

window.NinjaPopups.app.mount('#ninjapopups-app')