<template>
  <v-container id="subscribe" tag="section">
    <v-card color="rgba(200, 190, 82, 0.51)" class="pa-3">
      <v-container>
        <v-row>
          <v-col cols="12" md="6">
            <base-subheading class="mb-3">Subscribe</base-subheading>

            <p>
              Enter your email address to subscribe to this blog
              and receive notifications of new posts by email.
            </p>
          </v-col>

          <v-col cols="12" md="6">
            <base-subheading>Form</base-subheading>
            <v-row>
              <v-col cols="12" md="6">
                <v-text-field
                  :hide-details="error && error.length>0"
                  label="Name"
                  solo
                  class="mr-2"
                  v-model="form.name"
                  :error-messages="error.name"
                />
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                  :hide-details="error && error.length>0"
                  label="Mobile (optional)"
                  solo
                  v-model="form.mobile"
                  :error-messages="error.mobile"
                />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" md="8">
                <v-text-field
                  label="Your Email Address"
                  solo
                  v-model="form.email"
                  type="email"
                  :error-messages="error.email"
                  :hide-details="error && error.length>0"
                />
              </v-col>
              <v-col cols="12" md="4">
                <v-btn
                  block
                  color="secondary"
                  style="height: 48px"
                  @click.prevent="submit"
                  :loading="loading"
                  :disabled="loading"
                >Subscribe</v-btn>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-container>
    </v-card>
    <v-bottom-sheet v-model="sheet">
      <v-sheet class="text-center" height="200px">
        <v-btn class="mt-6" text color="red" @click="sheet = !sheet">close</v-btn>
        <div class="py-3">
          <h1>Thanks</h1>
          <p>We will give you update via email.</p>
        </div>
      </v-sheet>
    </v-bottom-sheet>
  </v-container>
</template>

<script>
import BaseSubheading from "./base/Subheading";
export default {
  name: "HomeSubscribe",
  components: {
    BaseSubheading
  },
  data() {
    return {
      form: {},
      loading: false,
      error: "",
      success: "",
      sheet: false
    };
  },
  methods: {
    async submit() {
      this.loading = true;
      this.success = "";
      this.error = "";
      try {
        const { data } = await this.$api.post("/subscribers", this.form);
        this.form = {};
        this.success = data;
        this.sheet = true;
      } catch (e) {
        this.error = e.response.data;
        let data = {};
        for (let d in e.response.data) {
          data[d] = e.response.data[d][0];
        }
        this.error = data;
        console.log(e.response.data);
      }
      this.loading = false;
    }
  }
};
</script>
