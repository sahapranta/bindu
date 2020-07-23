<template>
  <v-app>
    <v-navigation-drawer
      id="appDrawer"
      v-model="drawer"
      app
      fixed
      color="grey lighten-4"
      width="260"
      :mini-variant="mini"
    >
      <v-toolbar color="amber">
        <!-- <img src="bindu.jpg" height="36" alt="Vue Material Admin Template" /> -->
        <v-toolbar-title class="ml-0 pl-3">
          <span class="hidden-sm-and-down">Welcome Admin</span>
        </v-toolbar-title>
      </v-toolbar>
      <v-list dense expand>
        <template v-for="item in menus">
          <!--group with subitems-->
          <v-list-item
            :to="item.href ? item.href : null"
            ripple="ripple"
            :disabled="item.disabled"
            :target="item.target"
            rel="noopener"
            :key="item.name"
          >
            <v-list-item-action v-if="item.icon">
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
            <v-list-item-action v-if="item.subAction">
              <v-icon class="success--text">{{ item.subAction }}</v-icon>
            </v-list-item-action>
          </v-list-item>
        </template>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar app fixed color="amber">
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <span class="title ml-3 mr-5">
        Bindu&nbsp;
        <span class="font-weight-light">Dashboard</span>
      </span>
      <!-- <v-text-field solo-inverted flat hide-details label="Search" prepend-inner-icon="mdi-smagnify"></v-text-field> -->

      <v-spacer></v-spacer>
      <v-btn icon>
        <v-icon>mdi-bell</v-icon>
      </v-btn>

      <v-menu bottom left offset-y>
        <template v-slot:activator="{ on, attrs }">
          <v-btn color="dark" icon large v-bind="attrs" v-on="on">
            <v-icon>mdi-account-circle</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item @click.prevent>
            <v-list-item-avatar>
              <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John" />
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title>John Leider</v-list-item-title>
              <!-- <v-list-item-subtitle>Founder of Vuetify.js</v-list-item-subtitle> -->
            </v-list-item-content>
          </v-list-item>

          <v-list-item @click.prevent>
            <v-list-item-avatar>
              <v-icon>mdi-apps</v-icon>
            </v-list-item-avatar>
            <v-list-item-title>Admin</v-list-item-title>
          </v-list-item>
          <v-list-item @click.prevent="logout">
            <v-list-item-avatar>
              <v-icon>mdi-logout</v-icon>
            </v-list-item-avatar>
            <v-list-item-title>Log Out</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
    <v-main>
      <v-container>
        <nuxt />
      </v-container>
    </v-main>
    <core-footer />
  </v-app>
</template>

<script>
import CoreFooter from "../components/Footer";

export default {
  components: {
    CoreFooter
  },
  head() {
    return { title: "Admin Dashboard Panel" };
  },
  data() {
    return {
      drawer: false,
      mini: false,
      menus: [
        {
          title: "Dashboard",
          group: "apps",
          icon: "mdi-apps",
          name: "admin.dashboard",
          href: "/admin/dashboard"
        },
        {
          title: "New Issue",
          group: "apps",
          icon: "mdi-upload-network",
          name: "admin.newissue",
          href: "/admin/newissue"
        },
        {
          title: "All Issues",
          group: "apps",
          icon: "mdi-checkerboard",
          name: "admin.allissue",
          href: "/admin/allissue"
        },
        {
          title: "All Posts",
          group: "apps",
          icon: "mdi-library",
          name: "admin.allpost",
          href: "/admin/allpost"
        },
        {
          title: "All Books",
          group: "apps",
          icon: "mdi-book",
          name: "admin.allbook",
          href: "/admin/allbook"
        },
        {
          title: "Subscribers",
          group: "apps",
          icon: "mdi-account-switch",
          name: "subscribers",
          href: "/admin/subscribers"
        }
      ]
    };
  },
  methods: {
    logout() {
      this.$store.dispatch("auth/logout");
      this.$router.push("/admin");
    }
  }
};
</script>
