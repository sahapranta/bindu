<template>
  <v-badge bordered color="error" content="NEW" :value="isNew" overlap>
    <div
      class="feature is-revealing mx-2 elevation-3"
      v-ripple="{ class: `dark--text` }"
      @click="goto(data.slug)"
    >
      <div class="feature-inner">
        <div class="feature-icon">
          <v-img :src="data.image_url" max-height="278" :alt="data.name" />
        </div>
        <h4 class="feature-title h3-mobile mt-2">{{data.title}}</h4>
        <p class="text-sm" v-if="!noDescription" v-html="data.description.substr(0,50)"></p>
      </div>
    </div>
  </v-badge>
</template>

<script>
export default {
  name: "ItemCard",
  props: {
    data: {
      type: Object,
      default: () => ({})
    },
    noDescription: {
      type: Boolean,
      default: false
    },
    isNew: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    goto(slug) {
      this.$router.push({ name: "books.view", params: { slug } });
    }
  }
};
</script>