<template>
  <v-container>
    <v-row v-if="posts.length>0">
      <template v-for="(post, i) in posts">
        <v-col cols="12" md="3" :key="i">
          <v-card class="mx-auto" color="grey lighten-4" max-width="600" @click="goto(post.slug)">
            <v-img :aspect-ratio="16/9" :src="post.image_url" :alt="post.slug"></v-img>
            <v-card-text class="pt-6" style="position: relative;">
              <p class="text-h5 font-weight-light teal--text mb-2">{{post.title}}</p>
              <div class="font-weight-light title mb-2">{{post.body | short}}</div>
            </v-card-text>
          </v-card>
        </v-col>
      </template>
    </v-row>
    <div v-else>No Data to Show</div>
  </v-container>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      data: [],
      loading: false,
      error: ""
    };
  },
  computed: mapGetters({
    posts: "data/posts"
  }),
  filters: {
    short: function(value) {
      if (!value) return "";
      return value.substr(0, 80);
    }
  },
  methods: {
    async fetchData() {
      this.loading = true;
      try {
        const { data } = await this.$api.get("/post");
        this.data = data.data;
      } catch (e) {
        this.error = e;
      }
      this.loading = false;
    },
    goto(slug) {
      this.$router.push({ name: "blog.view", params: { slug } });
    }
  },
  mounted() {
    // this.fetchData();
    if (this.posts.length === 0) {
      this.$store.dispatch("data/getPosts");
    }
  }
};
</script>
<style>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: 0.5;
  position: absolute;
  width: 100%;
}
</style>