<template>
  <v-row>
    <v-col cols="12" md="3">
      <StatCard title="Today Reads" count="20" icon="mdi-eye-outline" />
    </v-col>
    <v-col cols="12" md="3">
      <StatCard title="Today Downloads" count="2" icon="mdi-arrow-down-bold-box-outline" />
    </v-col>
    <v-col cols="12" md="3">
      <StatCard title="Total Issues" :count="data.issueCount" icon="mdi-chemical-weapon" />
    </v-col>
    <v-col cols="12" md="3">
      <StatCard title="Total Books" :count="data.booksCount" icon="mdi-book-open-variant" />
    </v-col>
    <v-col cols="12" md="3">
      <StatCard title="Total Posts" :count="data.postsCount" icon="mdi-content-duplicate" />
    </v-col>
    <v-col cols="12" md="3">
      <StatCard
        title="Total Subscribers"
        :count="data.subscriberCount"
        icon="mdi-account-multiple"
      />
    </v-col>
  </v-row>
</template>

<script>
import StatCard from "../../components/StatCard";
export default {
  layout: "admin",
  middleware: "auth",
  data() {
    return {
      data: { issueCount: 0, subscriberCount: 0, booksCount: 0, postsCount: 0 }
    };
  },
  components: {
    StatCard
  },
  methods: {
    async fetchData() {
      try {
        const { data } = await this.$api.get("/report");
        this.data = data;
      } catch (e) {
        console.log(e);
      }
    }
  },
  mounted() {
    this.fetchData();
  }
};
</script>