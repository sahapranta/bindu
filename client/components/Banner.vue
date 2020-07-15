<template>
  <base-card dark>
    <v-img src="bindu.jpg" class="grey lighten-2" height="515" width="100%">
      <v-row class="fill-height pa-3" align="center">
        <v-col cols="12" md="6" class="bg-white text-center pa-3" offset-md="3">
          <h1 class="display-3 text-white">The Art Of Travel</h1>

          <div
            class="subheading text-uppercase pl-2 mb-4 text-white"
          >Finding Beauty, One flight at a time</div>

          <v-btn color="primary" depressed>Subscribe</v-btn>
        </v-col>
      </v-row>
    </v-img>
  </base-card>
</template>

<script>
import BaseCard from "./base/Card";
export default {
  name: "HomeBanner",
  components: {
    BaseCard
  }
};
</script>
<style scoped>
.text-white {
  color: #fff;
}
.bg-white {
  background: rgba(78, 78, 78, 0.4);
}
</style>
