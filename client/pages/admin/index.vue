<template>
  <v-row>
    <v-col cols="12" md="3">
      <StatCard title="Today Reads" count="20" icon="mdi-eye-outline" />
    </v-col>
    <v-col cols="12" md="3">
      <StatCard title="Today Downloads" count="2" icon="mdi-arrow-down-bold-box-outline" />
    </v-col>
    <v-col cols="12" md="3">
      <StatCard title="Total Issues" :count="issueCount" icon="mdi-chemical-weapon" />
    </v-col>
    <v-col cols="12" md="3">
      <StatCard title="Total Subscribers" :count="subscriberCount" icon="mdi-account-multiple" />
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
      issueCount: 0,
      subscriberCount: 0
    };
  },
  components: {
    StatCard
  },
  methods: {
    async fetchData() {
      try {
        const { data } = await this.$api.get("/report");
        this.issueCount = data.issueCount;
        this.subscriberCount = data.subscriberCount;
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