function page(path) {
    return () => import(`../pages/${path}`).then(m => m.default || m)
}

export default [
    {path: '/', name: 'welcome', component: page('welcome.vue')},
    {path: '/authorize/:code', name: 'authorize', component: page('authorize.vue')},

    {path: '/automation', name: 'automation', component: page('automation.vue')},
    {path: '/automation/:id', name: 'automation-edit', component: page('automation-edit.vue')},


    {path: '/export', name: 'export', component: page('export.vue')},
    {path: '/settings', name: 'settings', component: page('settings.vue')},


    {path: '/home', name: 'home', component: page('home.vue')},
    {path: '*', component: page('errors/404.vue')}
]
