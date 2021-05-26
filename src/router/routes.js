import { createWebHashHistory, createRouter } from "vue-router"

import AllPopups from '../components/AllPopups'
import SupportAndDocs from '../components/SupportAndDocs'
import PopupEditor from '../components/PopupEditor';
import GlobalView from '../Global'

const routes = [
    {        
        path: '/',
        component: GlobalView,
        props: true,
        children: [
            {
                path: '/',
                name: 'all-popups',
                component: AllPopups,
                meta: { title: 'All Popups' }
            },
            {
                path: '/support',
                name: 'support',
                component: SupportAndDocs,
                meta: { title: 'Support' }
            },
        ],
    },
    {
        path: '/popup-editor/:popup_id',
        name: 'popup-editor',
        component: PopupEditor,
        meta: { title: 'Popup Editor' }
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if(to.meta){
        document.title = 'Ninja Popup :: ' + to.meta.title;
    }else{
        document.title = 'Ninja Popup';
    }

    next();
});

export default router;