export default ({ store, redirect }) => {
    if (!store.getters["auth/token"]) {
        return redirect("/admin/login");
    }
};
