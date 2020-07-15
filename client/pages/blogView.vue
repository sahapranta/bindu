<template>
  <v-container fluid>
    <v-img :src="data.image_url" :alt="data.slug" height="55vh" class="white--text align-end">
      <div class="display-2 white--text pl-4 pb-4 line-height elevation-6">{{data.title}}</div>
    </v-img>
    <div class="grey lighten-3 px-4 py-8 mb-4">
      <div class="d-flex justify-space-between">
        <div class="font-weight-light grey--text title mb-2">
          Posted {{data.created}}
          <v-icon>mdi-clock-outline</v-icon>
        </div>
        <div v-if="noshare">
          <template v-for="(p,i) in items">
            <v-tooltip bottom :key="i">
              <template v-slot:activator="{ on, attrs }">
                <v-btn x-small fab @click="share(p.action)" v-bind="attrs" v-on="on" class="mr-1">
                  <v-icon>{{p.icon}}</v-icon>
                </v-btn>
              </template>
              <span>{{p.text}}</span>
            </v-tooltip>
          </template>
        </div>
        <div v-else>
          <template>
            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <v-btn small fab @click="share('native')" v-bind="attrs" v-on="on">
                  <v-icon>mdi-share</v-icon>
                </v-btn>
              </template>
              <span>Share Now</span>
            </v-tooltip>
          </template>
        </div>
      </div>
      <div v-html="data.description"></div>
    </div>
    <v-row class="mb-12">
      <template v-for="(post, i) in posts.slice(0,3)">
        <v-col cols="12" md="4" :key="i">
          <b>{{i+1}}.</b>
          <v-hover v-slot:default="{ hover }">
            <v-card
              :elevation="hover ? 12 : 2"
              :class="{ 'on-hover': hover }"
              @click="goto(post.slug)"
            >
              <v-img
                :src="post.image_url"
                class="white--text align-end"
                height="150"
                :style="`opacity:${hover?'1':'0.8'}`"
              >
                <v-card-title class="line-height">{{post.title}}</v-card-title>
              </v-img>
            </v-card>
          </v-hover>
        </v-col>
      </template>
    </v-row>
    <v-snackbar v-model="snackbar" :timeout="timeout">
      {{snacktext}}
      <template v-slot:action="{ attrs }">
        <v-btn color="white" icon v-bind="attrs" @click="snackbar = false">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </template>
    </v-snackbar>
  </v-container>
</template>

<script>
import copyToClipboard from "../utils/copyToClipboard";
import { mapGetters } from "vuex";
export default {
  head() {
    return {
      title: this.data.title
    };
  },
  data() {
    return {
      snackbar: false,
      timeout: 3000,
      snacktext: "",
      data: {},
      loading: false,
      items: [
        { icon: "mdi-facebook", text: "Share via Facebook", action: "fb" },
        { icon: "mdi-whatsapp", text: "Share to Whatsapp", action: "whatsapp" },
        {
          icon: "mdi-facebook-messenger",
          text: "Share via Messenger",
          action: "messenger"
        },
        { icon: "mdi-link", text: "Copy Link", action: "copy" }
      ]
    };
  },
  computed: {
    noshare() {
      return !window.navigator.share;
    },
    ...mapGetters({
      posts: "data/posts"
    })
  },
  methods: {
    goto(slug) {
      this.$router.push({ name: "blog.view", params: { slug } });
    },
    share(media) {
      if (media === "copy") {
        copyToClipboard(window.location.href);
        this.snackbar = true;
        this.snacktext = "Shareable Link Copied to your clipboard";
      } else if (media === "fb") {
        this.popupWindow(
          `https://www.facebook.com/sharer/sharer.php?u=${window.location.href}`
        );
      } else if (media === "whatsapp") {
        this.popupWindow(
          `https://www.facebook.com/sharer/sharer.php?u=${window.location.href}`
        );
      } else if (media === "messenger") {
      } else if (media === "native") {
        navigator
          .share({
            title: `${window.title}`,
            url: `${window.location.href}`
          })
          .then(() => {
            this.snackbar = true;
            this.snacktext = "Thanks for Sharing";
          })
          .catch(console.error);
      }
    },
    popupWindow(url, title, w = 360, h = 220) {
      const y = window.top.outerHeight / 2 + window.top.screenY - h / 2;
      const x = window.top.outerWidth / 2 + window.top.screenX - w / 2;
      return window.open(
        url,
        title,
        `toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=${w}, height=${h}, top=${y}, left=${x}`
      );
    },
    async fetchData() {
      this.loading = true;
      try {
        const { data } = await this.$api.get(
          "/post/" + this.$route.params.slug
        );
        this.data = data;
      } catch (e) {
        console.log(e);
      }
      this.loading = false;
    }
  },
  mounted() {
    this.fetchData();
    if (this.posts.length === 0) {
      this.$store.dispatch("data/getPosts");
    }
  }
};
</script>

<style scoped>
.line-height {
  line-height: 1.4;
  text-shadow: 2px 2px 3px rgb(78, 73, 73);
}
</style>