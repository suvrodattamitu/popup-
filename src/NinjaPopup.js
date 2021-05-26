import app from './elements'
import router from './router/routes'

app.use(router)

export default class NinjaPopup {
    constructor() {
        this.app = app;
    }

    $adminGet(options) {
        options.action = 'ninja_popup_admin_ajax';
        return window.jQuery.get(window.NinjaPopupAdmin.ajaxurl, options);
    }

    $adminPost(options) {
        options.action = 'ninja_popup_admin_ajax';
        return window.jQuery.post(window.NinjaPopupAdmin.ajaxurl, options);
    }
}