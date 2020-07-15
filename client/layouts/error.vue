<template>
  <v-row align="center" justify="center">
    <v-col cols="12" sm="8" md="4">
      <v-card class="elevation-5 pa-5 text-center">
        <v-img src="/page-not-found.jpg" alt="page-not-found" />
        <h1 v-if="error.statusCode === 404">{{ pageNotFound }}</h1>
        <h1 v-else>{{ otherError }}</h1>
        <a href="/">Home page</a>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  layout: "simple",
  props: {
    error: {
      type: Object,
      default: null
    }
  },
  data() {
    return {
      pageNotFound: "404 Not Found",
      otherError: "An error occurred"
    };
  },
  head() {
    const title =
      this.error.statusCode === 404 ? this.pageNotFound : this.otherError;
    return {
      title
    };
  }
};
</script>

<style scoped>
h1 {
  font-size: 20px;
}
</style>
