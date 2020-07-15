<template>
  <v-footer class="py-4" height="auto">
    <v-container class="mx-auto">
      <v-row>
        <v-col cols="9">
          <v-btn
            v-for="(item, i) in items"
            :key="i"
            :href="item.href"
            class="ml-0 mr-3"
            color="#fe9012"
            fab
            x-small
            target="_blank"
          >
            <v-icon v-text="item.icon" color="#fff" />
          </v-btn>
        </v-col>

        <v-spacer />

        <v-btn class="mr-0" icon title="Go to top" @click="goToTop(0)">
          <v-icon>mdi-chevron-up</v-icon>
        </v-btn>
      </v-row>
      <div class="text-center">
        <small>
          &copy;2020 hksamacar
          <v-icon v-text="'mdi-heart-outline'" color="#f00" small />
        </small>
      </div>
    </v-container>
  </v-footer>
</template>

<script>
export default {
  name: "CoreFooter",
  methods: {
    goToTop() {
      window.scrollTo(0, 0);
    }
  },

  data: () => ({
    items: [
      // {
      //   href: "#!",
      //   icon: "mdi-twitter"
      // },
      {
        href: "#!",
        icon: "mdi-instagram"
      },
      {
        href: "#!",
        icon: "mdi-facebook"
      },
      {
        href: "#!",
        icon: "mdi-google-plus"
      },
      // {
      //   href: "#!",
      //   icon: "mdi-reddit"
      // },
      // {
      //   href: "#!",
      //   icon: "mdi-discord"
      // },
      {
        href: "#!",
        icon: "mdi-pinterest"
      }
    ]
  })
};
</script>
