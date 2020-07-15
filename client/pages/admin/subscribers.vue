<template>
  <v-card>
    <v-card-title>Subscribers</v-card-title>
    <v-card-text>
      <v-alert dense outlined dismissible type="success" v-if="success">{{success}}</v-alert>
      <v-alert dense outlined dismissible type="error" v-if="error">{{error}}</v-alert>
      <v-data-table
        :items="dataWithIndex"
        :headers="headers"
        :loading="loading"
        loading-text="Loading... Please wait"
      >
        <template v-slot:item.status="{ item }">
          <v-switch
            v-model="item.status"
            :color="item.status?'success':'error'"
            hide-details
            @change="updateStatus(item)"
          ></v-switch>
        </template>
        <template v-slot:item.action="{ item }">
          <v-btn color="error" fab x-small dark icon @click.prevent="deleteSubscriber(item)">
            <v-icon>mdi-delete</v-icon>
          </v-btn>
          <v-btn
            color="success"
            fab
            x-small
            dark
            icon
            :to="{name:'subscriber.edit', params:{id:item.id}}"
          >
            <v-icon>mdi-pencil</v-icon>
          </v-btn>
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  layout: "admin",
  middleware: "auth",
  data() {
    return {
      headers: [
        { text: "#", value: "index", sortable: false },
        { text: "Name", value: "name" },
        { text: "Mobile", value: "mobile" },
        { text: "Email", value: "email" },
        { text: "Address", value: "address" },
        { text: "Created", value: "created" },
        { text: "Status", value: "status" },
        { text: "Action", value: "action" }
      ],
      data: [],
      error: "",
      success: "",
      loading: false
    };
  },
  methods: {
    async fetchData() {
      this.loading = true;
      try {
        const { data } = await this.$api.get("/subscribers");
        this.data = data;
      } catch (e) {
        console.log(e);
        this.error = e;
      }
      this.loading = false;
    },
    async updateStatus(sub) {
      this.reset();
      try {
        await this.$api.put(`/subscribers/${sub.id}`, { status: sub.status });
        this.fetchData();
        this.success = "Updated Successfully";
      } catch (e) {
        console.log(e);
        this.error = e;
      }
    },
    reset() {
      this.success = "";
      this.error = "";
    },
    async deleteSubscriber(sub) {
      this.reset();
      if (confirm("Are you sure?")) {
        try {
          await this.$api.delete(`/subscribers/${sub.id}`);
          this.fetchData();
          this.success = data.message;
        } catch (e) {
          console.log(e);
          this.error = e;
        }
      }
    }
  },
  computed: {
    dataWithIndex() {
      return this.data.map((d, i) => ({ ...d, index: i + 1 }));
    }
  },
  mounted() {
    this.fetchData();
  }
};
</script>