<template>
  <v-container fluid>
    <v-row justify="center">
      <v-col cols="12" md="4" sm="8">
        <v-img :src="data.image_url" :alt="data.title" class="fixedImg" max-width="320" />
      </v-col>
      <v-col cols="12" md="6">
        <div class="font-weight-light grey--text title mb-2">Description</div>
        <h3 class="display-3 font-weight-light teal--text mb-2">{{data.title}}</h3>
        <div class="d-flex align-center my-4">
          <v-rating
            v-model="ratings"
            background-color="orange lighten-3"
            color="orange"
            medium
            readonly
          ></v-rating>(150 Reviews)
        </div>
        <div class="font-weight-light title mb-2" v-html="data.description"></div>
        <v-btn color="pink white--text">Read</v-btn>
        <v-btn
          color="info"
          @click="download"
          :loading="downloading"
          :disabled="downloading"
        >Download</v-btn>
        <v-card class="mt-5">
          <v-card-text>
            <p class="grey--text title">Write Review</p>
            <v-alert dense outlined dismissible type="success" v-if="success">{{success}}</v-alert>
            <v-alert dense outlined dismissible type="error" v-if="error">{{error}}</v-alert>
            <div class="d-flex align-center">
              ({{rating}})
              <v-rating v-model="rating" background-color="orange lighten-3" color="orange" medium></v-rating>
            </div>
            <v-textarea
              placeholder="Write Your Review..."
              rows="2"
              counter="150"
              v-model="review"
              :error-messages="reviewError"
            />
            <v-btn
              color="primary mt-2 mb-5"
              :loading="loading"
              :disabled="loading"
              @click="submit"
            >Submit</v-btn>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  head() {
    return { title: this.data.title };
  },
  data() {
    return {
      ratings: 4,
      data: {},
      downloading: false,
      rating: 0,
      review: "",
      loading: false,
      error: "",
      success: "",
      reviewError: ""
    };
  },
  methods: {
    async submit() {
      this.loading = true;
      this.success = "";
      this.error = "";
      if (this.review.length <= 0) {
        this.reviewError = "Please Write Something...";
      } else if (this.rating < 1) {
        this.error = "Please Add Some Ratings";
      } else {
        try {
          const { data } = await this.$api.post("/books/review", {
            review: this.review,
            rating: this.rating
          });
          this.success = "Your Review Successfully Submitted";
        } catch (e) {
          this.error = e;
        }
      }
      setTimeout(() => {
        this.reset();
      }, 3000);
      this.loading = false;
    },
    reset() {
      this.review = "";
      this.reviewError = "";
      this.error = "";
      this.success = "";
    },
    async download() {
      this.downloading = true;
      const url = this.data.pdf_url;
      await this.$api.put(`/book/count/${this.data.slug}`);
      const link = document.createElement("a");
      link.href = url;
      link.download = this.data.title;
      link.click();
      this.downloading = false;
    },
    async fetchData() {
      this.loading = true;
      try {
        const { data } = await this.$api.get(
          "/book/" + this.$route.params.slug
        );
        this.data = data;
      } catch (e) {
        console.log(e);
      }
      this.loading = false;
    }
  },
  watch: {
    review() {
      this.reviewError = "";
    }
  },
  mounted() {
    this.fetchData();
  }
};
</script>

<style scoped>
@media only screen and (min-width: 768px) {
  .fixedImg {
    position: fixed;
  }
}
</style>