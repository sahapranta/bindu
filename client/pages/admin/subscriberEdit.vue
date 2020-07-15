<template>
  <v-card>
    <v-card-title>Update Subscriber</v-card-title>
    <v-card-text>
      <v-alert dense outlined dismissible type="success" v-if="success">{{success}}</v-alert>
      <v-alert dense outlined dismissible type="error" v-if="error">{{error}}</v-alert>
      <v-text-field label="Name" v-model="form.name" type="text" outlined dense />
      <div class="d-flex">
        <v-text-field label="Email" v-model="form.email" type="email" outlined dense class="mr-4" />
        <v-text-field label="Mobile" v-model="form.mobile" type="text" outlined dense />
      </div>
      <v-textarea label="Address" outlined v-model="form.address" dense></v-textarea>

      <v-row>
        <v-col cols="6">
          <v-btn color="error" block @click.prevent="cancel">Cancel</v-btn>
        </v-col>
        <v-col cols="6">
          <v-btn
            color="primary"
            block
            @click.prevent="submit"
            :loading="loading"
            :disabled="loading"
          >Update</v-btn>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  layout: "admin",
  middleware:'auth',
  data() {
    return {
      form: {},
      loading: false,
      error: "",
      success: ""
    };
  },
  methods: {
    async fetchData() {
      this.loading = true;
      try {
        const { data } = await this.$api.get(
          `/subscribers/${this.$route.params.id}`
        );
        this.form = data;
      } catch (e) {
        this.error = e;
      }
      this.loading = false;
    },
    async submit() {
      this.loading = true;
      try {
        const { data } = await this.$api.put(
          `/subscribers/${this.$route.params.id}`,
          this.form
        );
        this.success = "Subscriber Updated Successfully";
      } catch (e) {
        this.error = e;
      }
      this.loading = false;
    }
  },
  mounted() {
    this.fetchData();
  }
};
</script>