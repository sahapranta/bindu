<template>
  <v-row align="center" justify="center">
    <v-col cols="12" sm="8" md="4">
      <v-card class="elevation-12">
        <v-toolbar color="primary" dark flat>
          <v-toolbar-title>Login form</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-tooltip bottom>
            <template v-slot:activator="{ on }">
              <v-btn href="#" icon large target="_blank" v-on="on">
                <v-icon>mdi-account-plus</v-icon>
              </v-btn>
            </template>
            <span>Sign Up</span>
          </v-tooltip>
        </v-toolbar>
        <v-card-text>
          <!-- <v-alert dense outlined dismissible type="error" v-if="error">{{error}}</v-alert> -->
          <v-form>
            <v-text-field
              v-model="form.email"
              label="Email"
              :error-messages="error.email || ''"
              prepend-icon="mdi-account"
              type="email"
            ></v-text-field>

            <v-text-field
              v-model="form.password"
              id="password"
              label="Password"
              name="password"
              :error-messages="error.password || ''"
              prepend-icon="mdi-lock"
              type="password"
            ></v-text-field>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-checkbox v-model="remember" label="Remeber"></v-checkbox>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            @click.prevent="submit"
            :loading="loading"
            :disabled="loading"
          >Login</v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
export default {
  layout: "simple",
  middleware: "guest",
  data() {
    return {
      form: {},
      loading: false,
      error: "",
      remember: ""
    };
  },
  methods: {
    async submit() {
      this.loading = true;
      this.error = "";

      try {
        const { data } = await this.$api.post("/auth/login", this.form);

        this.$store.dispatch("auth/saveToken", {
          token: data.access_token,
          remember: this.remember
        });

        this.loading = false;
        this.$router.push("/admin");
      } catch (e) {
        this.error = e.response.data;
        this.loading = false;
      }
    }
  }
};
</script>