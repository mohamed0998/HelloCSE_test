
import {createWebHistory, createRouter} from "vue-router";

import Artists from '../components/Artists';
import EditArtist from '../components/EditArtist';
import ViewArtist from '../components/ViewArtist';
import AddArtist from '../components/AddArtist';

export const routes = [
    {
        name: 'artists',
        path: '/',
        component: Artists
    },
   
    {
        name: 'addartist',
        path: '/artists/add',
        component: AddArtist
    },
    {
        name: 'editartist',
        path: '/artists/edit/:id',
        component: EditArtist
    },
    {
        name: 'viewartist',
        path: '/artists/view/:id',
        component: ViewArtist
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
