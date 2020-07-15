<template>
  <v-slide-group v-model="model" class="pa-4" multiple show-arrows cycle>
    <v-slide-item v-for="(n, i) in issues || 4" :key="n.id" v-slot:default="{ active}">
      <v-card width="244" class="ma-4" @click="toggle(n.slug)">
        <v-img :src="n.image_url" max-height="150" :alt="n.title">
          <v-badge color="error" content="NEW" :value="i===0"></v-badge>
        </v-img>
        <v-card-title>{{n.title.substr(0,40)}}...</v-card-title>
        <!-- <v-card-text v-html="n.description.substr(0,50)">...</v-card-text> -->
      </v-card>
    </v-slide-item>
  </v-slide-group>
</template>

<script>
import ItemCard from "../components/ItemCard";
export default {
  name: "RecentIssueSlider",
  props: {
    issues: {
      type: Array
    }
  },
  components: {
    ItemCard
  },
  data() {
    return {
      model: []
    };
  },
  methods: {
    toggle(slug) {
      this.$router.push({
        name: "issues.view",
        params: { slug: slug }
      });
    }
  }
};
</script>