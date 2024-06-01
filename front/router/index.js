import { createRouter, createWebHistory } from 'vue-router'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {path: '/login', name: 'login', component: () => import('../views/Login.vue')},
    {path: '/registration', name: 'registration', component: ()=> import('../views/Registration.vue')},
    {path: '/trip', name: 'trip' ,component: ()=>import('../views/MainTripPage.vue')},
    {path: '/', name: 'trip2' ,component: ()=>import('../views/MainTripPage.vue')},
    {path: '/profile', name:'profile', component:()=>import('../views/Profile.vue')}
  ]
})

export default router
