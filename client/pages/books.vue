<template>
  <section class="features section text-center">
    <div class="features-inner section-inner">
      <h2 class="mb-2">Download Our Books</h2>
      <v-row v-if="books.length>0">
        <template v-for="(book, i) in books">
          <v-col cols="12" md="3" sm="6" :key="i">
            <div @click="goto(book.slug)">
              <item-card no-description :data="book" />
            </div>
          </v-col>
        </template>
      </v-row>
      <div v-else>NO DATA...</div>
    </div>
  </section>
</template>

<script>
import ItemCard from "../components/ItemCard";
import { mapGetters } from "vuex";
export default {
  components: {
    ItemCard
  },
  computed: mapGetters({
    books: "data/books"
  }),
  methods: {
    async fetchData() {
      this.loading = true;
      try {
        const { data } = await this.$api.get("/book");
        this.data = data.data;
      } catch (e) {
        this.error = e;
      }
      this.loading = false;
    },
    goto(slug) {
      this.$router.push({ name: "books.view", params: { slug } });
    }
  },
  data() {
    return {
      data: [],
      loading: false,
      error: ""
    };
  },
  filters: {
    short: function(value) {
      if (!value) return "";
      return value.substr(0, 80);
    }
  },
  mounted() {
    // this.fetchData();
    if (this.books.length === 0) {
      this.$store.dispatch("data/getBooks");
    }
  }
};
</script>

<style>
</style>