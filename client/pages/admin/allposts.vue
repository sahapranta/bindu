<template>
  <v-card>
    <v-card-title>All Posts</v-card-title>
    <v-card-text>
      <v-alert dense outlined dismissible type="success" v-if="success">{{success}}</v-alert>
      <v-alert dense outlined dismissible type="error" v-if="error">{{error}}</v-alert>
      <v-data-table
        :items="dataWithIndex"
        :headers="headers"
        :loading="loading"
        loading-text="Loading... Please wait"
      >
        <template v-slot:item.avatar="{ item }">
          <v-avatar size="36px">
            <img :src="item.image_url" :alt="item.slug" />
          </v-avatar>
        </template>
        <template v-slot:item.status="{ item }">
          <v-switch
            v-model="item.status"
            :color="item.status?'success':'error'"
            hide-details
            @change="updateStatus(item)"
          ></v-switch>
        </template>
        <template v-slot:item.action="{ item }">
          <v-btn color="error" fab x-small dark icon @click.prevent="deleteIssue(item)">
            <v-icon>mdi-delete</v-icon>
          </v-btn>
          <v-btn
            color="success"
            fab
            x-small
            dark
            icon
            :to="{name:'admin.edit', params:{type:'post', slug:item.slug}}"
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
        { text: "Thumb", value: "avatar", sortable: false },
        { text: "Title", value: "title", sortable: false },
        { text: "Status", value: "status" },
        { text: "Views", value: "view_count" },
        // { text: "Downloads", value: "download_count" },
        { text: "Action", value: "action" }
      ],
      data: [],
      loading: false,
      error: "",
      success: ""
    };
  },
  methods: {
    async fetchData() {
      this.reset();
      this.loading = true;
      try {
        const { data } = await this.$api.get("/post");
        this.data = data.data;
      } catch (e) {
        console.log(e);
        this.error = e;
      }
      this.loading = false;
    },
    reset() {
      this.success = "";
      this.error = "";
    },
    async updateStatus(issue) {
      this.reset();
      try {
        await this.$api.put(`/post/${issue.slug}`, { status: issue.status });
        this.fetchData();
        this.success = "Updated Successfully";
      } catch (e) {
        console.log(e);
        this.error = e;
      }
    },
    async deleteIssue(issue) {
      this.reset();
      if (confirm("Are you sure?")) {
        try {
          await this.$api.delete(`/post/${issue.slug}`);
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