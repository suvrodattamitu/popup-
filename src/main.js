import mitt from 'mitt';
window.mitt = window.mitt || new mitt()

window.FizzyPopups.app.mixin({
    methods: {
        $adminGet(options) {
            options.action = 'fizzy_popup_admin_ajax';
            options['fizzy_popups_admin_nonce'] = window.FizzyPopupsAdmin.fizzy_popups_admin_nonce;
            return window.jQuery.get(window.FizzyPopupsAdmin.ajaxurl, options);
        },
    
        $adminPost(options) {
            options.action = 'fizzy_popup_admin_ajax';
            options['fizzy_popups_admin_nonce'] = window.FizzyPopupsAdmin.fizzy_popups_admin_nonce;
            return window.jQuery.post(window.FizzyPopupsAdmin.ajaxurl, options);
        }
    }
})

window.FizzyPopups.app.mount('#fizzypopups-app')