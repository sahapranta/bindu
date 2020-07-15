<template>
  <v-container>
    <v-row v-if="issues.length>0">
      <template v-for="(issue, i) in issues">
        <v-col cols="12" md="3" :key="i">
          <v-card @click="goto(issue.slug)" max-height="260" style="overflow:hidden">
            <v-img :src="issue.image_url" max-height="150" :alt="issue.slug">
              <v-badge color="error" content="NEW" :value="i===0"></v-badge>
            </v-img>
            <v-card-title>{{issue.title.substr(0,30)}}...</v-card-title>
            <v-card-text v-html="issue.description.substr(0,120)"></v-card-text>
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
  filters: {
    short: function(value) {
      if (!value) return "";
      return value.substr(0, 80);
    }
  },
  computed: mapGetters({
    issues: "data/issues"
  }),
  methods: {
    async fetchData() {
      this.loading = true;
      try {
        const { data } = await this.$api.get("/issue");
        this.data = data.data;
      } catch (e) {
        this.error = e;
      }
      this.loading = false;
    },
    goto(slug) {
      this.$router.push({ name: "issues.view", params: { slug } });
    }
  },
  mounted() {
    // this.fetchData();
    if (this.issues.length === 0) {
      this.$store.dispatch("data/getIssues");
    }
  }
};
</script>