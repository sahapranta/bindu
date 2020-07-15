require("dotenv").config();
const { join } = require("path");
const { copySync, removeSync } = require("fs-extra");

module.exports = {
    mode: "spa", // Comment this for SSR
    srcDir: __dirname,
    env: {
        apiUrl: process.env.API_URL || process.env.APP_URL + "/api",
        appName: process.env.APP_NAME || "Laravel Nuxt",
        appLocale: process.env.APP_LOCALE || "en"
    },
    head: {
        title: process.env.APP_NAME,
        titleTemplate: "%s - " + process.env.APP_NAME,
        meta: [
            { charset: "utf-8" },
            {
                name: "viewport",
                content: "width=device-width, initial-scale=1"
            },
            {
                hid: "description",
                name: "description",
                content: "Nuxt.js project"
            }
        ],
        link: [{ rel: "icon", type: "image/x-icon", href: "/favicon.ico" }]
    },
    loading: { color: "#007bff" },
    css: ["assets/scss/style.scss"],
    // router: {
        // middleware: ["auth", "guest"]
    // },
    plugins: [
        // "~components/global",
        // "~plugins/i18n",
        "~plugins/axios",
        "~plugins/tiptap",
        "~plugins/nuxt-client-init" // Comment this for SSR
    ],
    modules: ["@nuxtjs/router"],
    build: {
        extractCSS: true
    },
    buildModules: ["@nuxtjs/vuetify"],
    hooks: {
        generate: {
            done(generator) {
                // Copy dist files to public/_nuxt
                if (
                    generator.nuxt.options.dev === false &&
                    generator.nuxt.options.mode === "spa"
                ) {
                    const publicDir = join(
                        generator.nuxt.options.rootDir,
                        "public",
                        "_nuxt"
                    );
                    removeSync(publicDir);
                    copySync(
                        join(generator.nuxt.options.generate.dir, "_nuxt"),
                        publicDir
                    );
                    copySync(
                        join(generator.nuxt.options.generate.dir, "200.html"),
                        join(publicDir, "index.html")
                    );
                    removeSync(generator.nuxt.options.generate.dir);
                }
            }
        }
    }
};
