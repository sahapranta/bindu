export const state = () => ({
    issues: [],
    books: [],
    posts: []
});

export const getters = {
    issues: state => state.issues,
    books: state => state.books,
    posts: state => state.posts
};

export const mutations = {
    SET_ISSUES(state, payload) {
        state.issues = payload;
    },
    SET_BOOKS(state, payload) {
        state.books = payload;
    },
    SET_POSTS(state, payload) {
        state.posts = payload;
    }
};

export const actions = {
    async getIssues({ commit }) {
        try {
            const { data } = await this.$api.get("/issue");
            commit("SET_ISSUES", data.data);
        } catch (e) {
            console.log(e);
        }
    },
    async getBooks({ commit }) {
        try {
            const { data } = await this.$api.get("/book");
            commit("SET_BOOKS", data.data);
        } catch (e) {
            console.log(e);
        }
    },
    async getPosts({ commit }) {
        try {
            const { data } = await this.$api.get("/post");
            commit("SET_POSTS", data.data);
        } catch (e) {
            console.log(e);
        }
    }
};
