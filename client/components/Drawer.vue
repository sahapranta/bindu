<template>
  <v-navigation-drawer v-model="drawer" app dark temporary>
    <v-list>
      <v-list-item
        v-for="(link, i) in links"
        :key="i"
        :to="link.to"
        :href="link.href"
        @click="onClick($event, link)"
      >
        <v-icon v-text="link.icon" class="mr-2"/>
        <v-list-item-title v-text="link.text" />
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
// Utilities
import { mapGetters, mapMutations } from "vuex";

export default {
  name: "CoreDrawer",

  computed: {
    ...mapGetters({
      links: "main/links"
    }),    
    drawer: {
      get() {
        return this.$store.state.main.drawer;
      },
      set(val) {
        this.setDrawer(val);
      }
    }
  },

  methods: {
    ...mapMutations({
      setDrawer: "main/setDrawer"
    }),
    onClick(e, item) {
      e.stopPropagation();

      if (item.to === "/") {
        this.$vuetify.goTo(0);
        this.setDrawer(false);
        return;
      }

      if (item.to || !item.href) return;

      this.$vuetify.goTo(item.href);
      this.setDrawer(false);
    }
  }
};
</script>
