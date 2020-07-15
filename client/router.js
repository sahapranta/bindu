import Vue from "vue";
import Router from "vue-router";
import { scrollBehavior } from "~/utils";

Vue.use(Router);
const page = path => () => import(`~/pages/${path}`).then(m => m.default || m);

const routes = [
    { path: "/", name: "welcome", component: page("index.vue") },
    { path: "/admin", name: "admin", component: page("admin/index.vue") },
    {
        path: "/admin/dashboard",
        name: "admin.dashboard",
        component: page("admin/index.vue")
    },
    {
        path: "/admin/login",
        name: "admin.login",
        component: page("admin/login.vue"),
        meta: { requiresAuth: true }
    },
    {
        path: "/admin/:type/:slug",
        name: "admin.edit",
        component: page("admin/edit.vue")
    },
    {
        path: "/admin/newissue",
        name: "admin.newissue",
        component: page("admin/newissue.vue")
    },
    {
        path: "/admin/allissue",
        name: "admin.allissue",
        component: page("admin/allissues.vue")
    },
    {
        path: "/admin/allpost",
        name: "admin.allpost",
        component: page("admin/allposts.vue")
    },
    {
        path: "/admin/allbook",
        name: "admin.allbook",
        component: page("admin/allbooks.vue")
    },
    {
        path: "/admin/subscribers",
        name: "admin.subscribers",
        component: page("admin/subscribers.vue")
    },
    {
        path: "/admin/subscribers/:id",
        name: "subscriber.edit",
        component: page("admin/subscriberEdit.vue")
    },
    { path: "/blog", name: "blog", component: page("blog.vue") },
    { path: "/blog/:slug", name: "blog.view", component: page("blogView.vue") },
    {
        path: "/books/:slug",
        name: "books.view",
        component: page("bookView.vue")
    },
    { path: "/issues", name: "issues", component: page("issues.vue") },
    { path: "/books", name: "books", component: page("books.vue") },
    { path: "/issues/:slug", name: "issues.view", component: page("issue.vue") }
];

export function createRouter() {
    return new Router({
        routes,
        scrollBehavior,
        mode: "history"
    });
}
