<template>
  <!-- <v-app-bar app flat color="orange" elevate-on-scroll>
    <v-app-bar-nav-icon class="hidden-md-and-up" @click="toggleDrawer" />

    <v-container class="mx-auto py-0">
      <v-row align="center">
        <v-img
          src="/logo.png"
          class="mr-5"
          contain
          height="48"
          width="48"
          max-width="48"
          @click="$vuetify.goTo(0)"
        />

        <v-btn
          v-for="(link, i) in links"
          :key="i"
          v-bind="link"
          class="hidden-sm-and-down"
          text
          @click="onClick($event, link)"
        >{{ link.text }}</v-btn>

        <v-spacer />

        <v-text-field
          append-icon="mdi-magnify"
          flat
          hide-details
          solo
          style="max-width: 200px;"
          label="Search..."
        />
      </v-row>
    </v-container>
  </v-app-bar>-->
  <v-bottom-navigation v-model="bottomNav" shift grow color="error" app>
    <v-btn to="/" link>
      <span>Home</span>
      <v-icon>mdi-home</v-icon>
    </v-btn>

    <v-btn to="/issues" link>
      <span>Issue</span>
      <v-icon>mdi-library</v-icon>
    </v-btn>

    <v-btn to="/books" link>
      <span>Books</span>
      <v-icon>mdi-book</v-icon>
    </v-btn>

    <v-btn to="/blog" link>
      <span>Blog</span>
      <v-icon>mdi-file-document</v-icon>
    </v-btn>
  </v-bottom-navigation>
</template>

<script>
// Utilities
import { mapGetters, mapMutations } from "vuex";

export default {
  name: "AppBar",
  computed: {
    ...mapGetters({
      link: "main/links"
    }),
    links() {
      return this.link.map(l => ({ text: l.text, href: l.href }));
    },
    color() {
      switch (this.bottomNav) {
        case 0:
          return "blue-grey";
        case 1:
          return "teal";
        case 2:
          return "brown";
        case 3:
          return "indigo";
      }
    }
  },
  data() {
    return {
      bottomNav: 3
    };
  },
  methods: {
    toggleDrawer() {
      this.$store.commit("main/toggleDrawer");
    },
    onClick(e, item) {
      e.stopPropagation();

      if (item.to || !item.href) return;

      // this.$vuetify.goTo(item.href.endsWith("!") ? 0 : item.href);
      this.$router.push({ path: item.href });
    }
  }
};
</script>
