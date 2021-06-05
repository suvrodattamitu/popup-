import app from './elements'
import router from './router/routes'

app.use(router)

export default class FizzyPopups {
    constructor() {
        this.app = app;
    }

    $adminGet(options) {
        options.action = 'fizzy_popup_admin_ajax';
        return window.jQuery.get(window.FizzyPopupsAdmin.ajaxurl, options);
    }

    $adminPost(options) {
        options.action = 'fizzy_popup_admin_ajax';
        return window.jQuery.post(window.FizzyPopupsAdmin.ajaxurl, options);
    }
}