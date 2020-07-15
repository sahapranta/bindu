<template>
  <v-card elevation="2">
    <v-card-title>{{title | capitalize}}</v-card-title>
    <v-card-text>
      <v-row justify="space-between" class="px-4">
        <h2>{{count.toLocaleString()}}</h2>
        <v-icon>{{icon}}</v-icon>
      </v-row>
      <v-sparkline :labels="labels" :value="value" :color="sparkColor" line-width="2" height="30"></v-sparkline>
      <!-- <v-divider class="my-2"></v-divider>
      <v-icon class="mr-2" small>mdi-clock</v-icon>
      <span class="caption grey--text font-weight-light">Updated 2 minutes ago</span> -->
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: {
    icon: String,
    title: String,
    count: [String, Number],
    sparkColor: {
      type: String,
      default: "amber"
    }
  },
  filters: {
    capitalize: function(value) {
      if (!value) return "";
      value = value.toString();
      value = value
        .split("_")
        .map(v => v.charAt(0).toUpperCase() + v.slice(1))
        .join(" ");
      return value;
    }
  },
  data() {
    return {
      labels: [],
      value: [200, 175, 210, 230, 310, 60, 150, 40]
    };
  }
};
</script>