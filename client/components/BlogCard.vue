<template>
  <v-card class="mx-auto" max-width="400" elevation="4" @click="goto(data.slug)">
    <v-img
      v-ripple="{ class: `info--text` }"
      class="feature-extended-image is-revealing"
      :src="data.image_url"
      :alt="data.slug"
      max-height="180"
    ></v-img>

    <v-card-title class="teal--text" v-ripple="{ class: `info--text` }">{{data.title}}</v-card-title>
    <!-- <v-card-text class="text--primary" v-html="data.description.substr(0,80)">
      Where text is visible, people tend to
      focus on the textual content rather than
      upon overall presentation
    </v-card-text>-->
  </v-card>
</template>

<script>
export default {
  name: "BlogCard",
  props: {
    data: {
      type: Object,
      default: () => ({})
    }
  },
  filters: {
    short: function(value) {
      if (!value) return "";
      return value.substr(0, 80);
    }
  },
  methods: {
    goto(slug) {
      this.$router.push({ name: "blog.view", params: { slug } });
    }
  }
};
</script>