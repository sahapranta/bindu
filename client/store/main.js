// state
export const state = () => ({
    drawer: false,
    items: [
        {
            text: "Home",
            href: "/",
            icon: "mdi-home"
        },
        {
            text: "About",
            href: "/about",
            icon: "mdi-account-box-outline"
        },
        {
            text: "Issues",
            href: "/issues",
            icon: "mdi-archive"
        },
        {
            text: "Blog",
            href: "/blog",
            icon: "mdi-newspaper"
        },
        {
            text: "Books",
            href: "/books",
            icon: "mdi-book-open"
        },
        {
            text: "Login",
            href: "/admin/login",
            icon: "mdi-login"
        }
    ],
    categories: []
});

export const getters = {
    links: (state, getters) => {
        // return state.items.concat(getters.categories);
        return state.items;
    }
};

export const mutations = {
    setDrawer: (state, payload) => (state.drawer = payload),
    toggleDrawer: state => (state.drawer = !state.drawer)
};
