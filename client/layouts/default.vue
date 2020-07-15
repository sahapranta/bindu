<template>
  <v-app>
    <!-- <core-drawer /> -->
    <nuxt />
    <app-bar />
    <!-- <core-footer /> -->
  </v-app>
</template>

<script>
import AppBar from "../components/AppBar";
// import CoreFooter from "../components/Footer";

export default {
  components: {
    AppBar,
    // CoreFooter
  }
};
</script>
