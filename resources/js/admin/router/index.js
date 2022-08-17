import store from '../store/index.js';
import { sync } from 'vuex-router-sync';
import routes from './router';
import { createRouter, createWebHistory } from 'vue-router';
import Cookies from 'js-cookie'

//Vue INIT

// // The middleware for every page of the application.
// const globalMiddleware = ['check-auth'];

// // Load middleware modules dynamically.
// const routeMiddleware = resolveMiddleware(
//     require.context('../middleware', false, /.*\.js$/)
// )
// Load router module dynamically


let  app_name = process.env.MIX_APP_NAME;
let DEFAULT_TITLE = 'Dashboard';
const router = createRoute();
console.log('router', process.env.MIX_APP_NAME);

sync(store, router);

export default router;

function createRoute() {
    const router = createRouter({
        // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
        history: createWebHistory('/admin'),
        routes, // short for `routes: routes`
    })
    // router.beforeEach(beforeEach)
    // router.afterEach(afterEach)

    const isAuthenticated = Cookies.get('isLoggedIn');
    console.log('isAuthenticated', Cookies.get('isLoggedIn'));
    router.beforeEach(function (to, from, next) {
        // const isAuthenticated = true;

        if (to.name != 'Login' && isAuthenticated == 'false') {
            next('/login');

            return;
        }
        if (to.name === 'Login' && isAuthenticated === 'true') {
            next('/');

            return;
        }

        if (to.name === 'Dashboard' && isAuthenticated !== 'true') {
            next('/login');

            return;
        }


        else next();
    });
    router.afterEach((to, from) => {
        let routeName = to.name;
        let routeTitle = routeName+' - '+app_name;
        document.title = routeTitle || DEFAULT_TITLE;
        return;
    })
    return router
}
