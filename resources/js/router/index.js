import { createRouter,createWebHistory } from "vue-router";

import HomeView from '../pages/HomeView.vue'
import AboutView from '../pages/AboutView.vue'
import ContactView from '../pages/ContactView.vue'
import BlogView from '../pages/BlogView.vue'
import SingleBlog from '../pages/SingleBlog.vue'
import LoginView from '../pages/LoginView.vue'
import RegisterView from '../pages/RegisterView.vue'
import DashboardView from '../pages/DashboardView.vue'
import CreateCategory from '../pages/Category/CreateCategory.vue'
import CategoryList from '../pages/Category/CategoryList.vue'
import EditCategory from '../pages/Category/EditCategory.vue'
import CreatePost from '../pages/Posts/CreatePost.vue'
import DashboardPostList from '../pages/Posts/DashboardPostList.vue'
import EditPost from '../pages/Posts/EditPost.vue'


const routes=[
    {
        path:"/",
        name:'HomeView',
        component:HomeView
    },
    {
        path:"/about",
        name:'AboutView',
        component:AboutView
    },
    {
        path:"/contact",
        name:'ContactView',
        component:ContactView
    },
    {
        path:"/blog",
        name:'BlogView',
        component:BlogView
    },
    {
        path:"/blog/:slug",
        name:'SingleBlog',
        component:SingleBlog,
        props:true
    },
    {
        path:"/login",
        name:'LoginView',
        component:LoginView,
        meta:{requiresGuest:true}
    },
    {
        path:"/register",
        name:'RegisterView',
        component:RegisterView,
        meta:{requiresGuest:true}
    },
    {
        path:"/dashboard",
        name:'DashboardView',
        component:DashboardView,
        meta:{requiresAuth:true}
    },
    {
        path:"/categories/create",
        name:'CreateCategory',
        component:CreateCategory,
        meta:{requiresAuth:true}
    },
    {
        path:"/categories",
        name:'CategoryList',
        component:CategoryList,
        meta:{requiresAuth:true}
    },
    {
        path:"/categories/:id/edit",
        name:'EditCategory',
        component:EditCategory,
        meta:{requiresAuth:true},
        props:true
    },
    {
        path:"/post/create",
        name:'CreatePost',
        component:CreatePost,
        meta:{requiresAuth:true},
        props:true
    },
    {
        path:"/dashboard-posts",
        name:'DashboardPostList',
        component:DashboardPostList,
        meta:{requiresAuth:true},
        props:true
    },
    {
        path:"/posts/:slug/edit",
        name:'EditPost',
        component:EditPost,
        meta:{requiresAuth:true},
        props:true
    },
]


const router = createRouter({
    history: createWebHistory(),
    routes
  })
  router.beforeEach((to,from)=>{
    const authenticated=localStorage.getItem('authenticated');

    if(to.meta.requiresGuest && authenticated){
        return {
            name:'DashboardView'
        }
    }else if(to.meta.requiresAuth && !authenticated){
        return{
            name:'LoginView'
        }
    }
})
  export default router;