import Index from "../pages/dashboard/Index.vue";
import Users from "../pages/users/Index.vue";
import Login from '../pages/login/Index.vue';
import Cuatro04 from '../pages/NotFound.vue';

const routes = [

    { path: '/:pathMatch(.*)*', name: 'not-found', component: Cuatro04, meta: { sidebar: false } },
    { path: '/login', name: 'Login', component: Login, meta: { sidebar: false } },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Index,
        meta: { sidebar: true, role: 1, icon: 'dashboard' }
    },
    {
        path: '/users',
        name: 'Usuarios',
        component: Users,
        meta: { sidebar: true, role: 1, icon: 'group' }
    },
    {
        path: '/users/:id',
        name: 'Usuario',
        component: Users,
        meta: { sidebar: false}
    },


];
export default routes;
