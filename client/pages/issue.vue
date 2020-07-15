<template>
  <v-main>
    <v-container v-if="issue">
      <v-row align="start" justify="center">
        <v-col cols="12" md="5">
          <h1 class="display-1">{{issue.title}}</h1>
          <p class="red--text">Total Pages: {{numPages}}</p>
          <p v-html="issue.description"></p>
          <div class="mb-3 d-flex justify-space-around align-center">
            <div>
              <v-btn @click="scale -= scale > 0.2 ? 0.1 : 0" small>
                <v-icon v-text="'mdi-magnify-minus-outline'" />
              </v-btn>
              <v-chip>{{formattedZoom}}%</v-chip>
              <v-btn @click="scale += scale < 2 ? 0.1 : 0" small>
                <v-icon v-text="'mdi-magnify-plus-outline'" />
              </v-btn>
            </div>
            <div class="d-flex justify-center">
              <v-btn @click="prevPage" :disabled="page===1" small class="mr-2">
                <v-icon v-text="'mdi-arrow-left-bold-circle'" />
              </v-btn>
              <v-btn @click="nextPage" :disabled="page===numPages" small>
                <v-icon v-text="'mdi-arrow-right-bold-circle'" />
              </v-btn>
            </div>
          </div>
          <div class="text-center">
            <small class="blue--text text-caption">Current Page: {{page}}</small>
          </div>
        </v-col>
        <v-col cols="12" md="7">
          <v-sheet
            class="pdf-container"
            align="center"
            v-if="pdfdata"
            v-touch="{
      left: () => swipe('Left'),
      right: () => swipe('Right'),
      up: () => swipe('Up'),
      down: () => swipe('Down')
    }"
            :elevation="2"
          >
            <pdf :src="pdfdata" :page="page" :scale.sync="scale">
              <template slot="loading">loading content here...</template>
            </pdf>
          </v-sheet>
          <div class="d-flex align-center justify-center my-8">
            <v-btn
              color="primary"
              :loading="downloading"
              :disabled="downloading"
              @click="download"
            >Download</v-btn>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </v-main>
</template>

<script>
import pdfvuer from "pdfvuer";
export default {
  name: "Issue",
  head() {
    return { title: this.issue.title };
  },
  components: {
    pdf: pdfvuer
  },
  data() {
    return {
      loading: false,
      downloading: false,
      page: 1,
      issue: {},
      numPages: 0,
      pdfdata: undefined,
      error: "",
      scale: "page-width"
    };
  },
  computed: {
    formattedZoom() {
      return Number.parseInt(this.scale * 100);
    }
  },
  methods: {
    async fetchData() {
      this.loading = true;
      try {
        const { data } = await this.$api.get(
          `/issue/${this.$route.params.slug}`
        );
        this.issue = data;
      } catch (e) {
        console.log(e);
        this.error = e;
      }
      this.loading = false;
    },
    getPdf() {
      let self = this;
      self.pdfdata = pdfvuer.createLoadingTask(this.issue.pdf_url);
      self.pdfdata.then(pdf => {
        self.numPages = pdf.numPages;
      });
    },
    changePage() {
      this.page += 1;
    },
    prevPage() {
      if (this.page > 1) {
        this.page -= 1;
      }
    },
    nextPage() {
      if (this.page < this.numPages) {
        this.page += 1;
      }
    },
    swipe(direction) {
      if (direction === "left") {
        this.prevPage();
      }
      if (direction === "right") {
        this.nextPage();
      }
    },
    async download() {
      this.downloading = true;
      const url = this.issue.pdf_url;
      await this.$api.put(`/issue/count/${this.issue.slug}`);
      const link = document.createElement("a");
      link.href = url;
      link.download = this.issue.title;
      link.click();
      // URL.revokeObjectURL(link.href);
      // window.open("/storage/uploads/pdf/" + this.issue.pdf, "_blank");
      this.downloading = false;
    }
  },
  async mounted() {
    await this.fetchData();
    this.getPdf();
  }
};
</script>

<style scoped>
.pdf-container {
  position: relative;
  overflow: scroll;
  max-height: 80vh;
  /* border: 2px solid transparent;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1), 0 1px 4px rgba(0, 0, 0, 0.15),
    0 2px 8px rgba(0, 0, 0, 0.2); */
  scrollbar-width: none;
  -ms-overflow-style: none;
}
.pdf-container::-webkit-scrollbar {
  width: 0;
  display: none;
  background: transparent; /* Optional: just make scrollbar invisible */
}
</style>