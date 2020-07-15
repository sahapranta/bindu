<template>
  <v-main>
    <!-- <v-container> -->
    <!-- <banner /> -->
    <!-- </v-container> -->
    <v-parallax :height="height" src="/bindu.jpg">
      <recent-issue-slider :issues="issues" />
    </v-parallax>

    <section class="features section text-center">
      <div class="features-inner section-inner">
        <h2 class="mb-2">Download Our Books</h2>
        <div class="features-wrap">
          <template v-for="(book, i) in books.slice(0,4)">
            <item-card no-description :key="i" :data="book" />
          </template>
        </div>
      </div>
    </section>

    <v-container>
      <v-sheet class="mx-auto pa-4">
        <h2 class="text-center mb-4">Read Our Blog</h2>
        <v-row>
          <v-col md="4" sm="6" v-for="(p, i) in posts.slice(0,6)" :key="i">
            <blog-card :data="p" />
          </v-col>
        </v-row>
        <div class="text-center">
          <v-btn depressed color="primary" to="/blog">Find More...</v-btn>
        </div>
      </v-sheet>
    </v-container>
    <subscribe />
  </v-main>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Subscribe from "../components/Subscribe";
import Banner from "../components/Banner";
import ItemCard from "../components/ItemCard";
import BlogCard from "../components/BlogCard";
import RecentIssueSlider from "../components/RecentIssueSlider";
export default {
  components: {
    Subscribe,
    Banner,
    BlogCard,
    ItemCard,
    RecentIssueSlider
  },
  head() {
    return { title: "Krishna Kathamrita Bindu" };
  },
  data() {
    return {
      model: [],
      loading: false,
      error: ""
    };
  },
  methods: {
    ...mapActions({
      getIssues: "data/getIssues",
      getBooks: "data/getBooks",
      getPosts: "data/getPosts"
    }),
    async fetchData() {
      this.loading = true;
      await this.getIssues();
      await this.getBooks();
      await this.getPosts();
      this.loading = false;
    }
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/check",
      issues: "data/issues",
      books: "data/books",
      posts: "data/posts"
    }),
    height() {
      return window.innerHeight;
    }
  },
  mounted() {
    this.fetchData();
  }
};
</script>