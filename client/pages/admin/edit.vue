<template>
  <v-card>
    <v-card-title>Update {{type.toUpperCase()}}</v-card-title>
    <v-card-text>
      <v-alert dense outlined dismissible type="success" v-if="success">{{success}}</v-alert>
      <v-alert dense outlined dismissible type="error" v-if="validation_error">{{validation_error}}</v-alert>
      <v-text-field
        outlined
        dense
        label="Title"
        v-model="form.title"
        :error-messages="error.title||''"
      />

      <v-text-field
        outlined
        dense
        label="Slug"
        v-model="form.slug"
        :error-messages="error.slug||''"
      />
      <tiptap-vuetify
        v-model="form.description"
        :extensions="extensions"
        placeholder="Add Short Description..."
      />
      <v-row align="center" class="mt-2 pl-0">
        <v-col cols="12" md="4">
          <v-hover>
            <template v-slot:default="{ hover }">
              <v-card class="mx-auto" max-width="344">
                <v-img :src="form.image_url" max-height="150"></v-img>
                <v-card-text>Thumbnail</v-card-text>
                <v-fade-transition>
                  <v-overlay v-if="hover" absolute color="#036358">
                    <v-btn color="info" @click.prevent="imageUpload('thumbnail')">Upload</v-btn>
                  </v-overlay>
                </v-fade-transition>
              </v-card>
            </template>
          </v-hover>
        </v-col>
        <v-col cols="12" md="4">
          <v-hover>
            <template v-slot:default="{ hover }">
              <v-card class="mx-auto" max-width="344">
                <v-img v-if="form.pdf" src="/upload-pdf.png" height="150"></v-img>
                <v-card-text>Pdf</v-card-text>
                <v-progress-linear
                  color="deep-purple accent-4"
                  indeterminate
                  height="4"
                  v-if="pdfloader"
                ></v-progress-linear>
                <v-fade-transition>
                  <v-overlay v-if="hover" absolute color="#036358">
                    <v-btn color="info" @click.prevent="imageUpload('pdf')">Upload</v-btn>
                  </v-overlay>
                </v-fade-transition>
              </v-card>
            </template>
          </v-hover>
        </v-col>
      </v-row>
      <input class="d-none" @change="upload('thumbnail')" type="file" ref="thumbnail" />
      <input class="d-none" @change="upload('pdf')" type="file" ref="pdf" accept="application/pdf" />
      <!-- <v-switch v-model="form.status" label="Status" class="mx-2"></v-switch> -->
    </v-card-text>
    <v-card-actions>
      <v-btn color="error" @click.prevent="reset">Reset</v-btn>
      <v-btn color="primary" @click.prevent="submit" :loading="loading" :disabled="loading">Submit</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import {
  TiptapVuetify,
  Bold,
  Underline,
  Paragraph,
  BulletList,
  OrderedList,
  ListItem,
  Link,
  Blockquote,
  HardBreak,
  History
} from "tiptap-vuetify";
import { objectToFormData } from "@/utils/ObjectToFormData";
export default {
  layout: "admin",
  middleware: "auth",
  components: {
    TiptapVuetify
  },
  data() {
    return {
      form: {},
      loading: false,
      error: "",
      pdfloader: false,
      validation_error: "",
      success: "",
      extensions: [
        History,
        Blockquote,
        Link,
        Underline,
        ListItem,
        BulletList,
        OrderedList,
        Bold,
        Paragraph,
        HardBreak
      ],
      thumbnail_url: ""
    };
  },
  computed: {
    type() {
      return this.$route.params.type;
    }
  },
  methods: {
    imageUpload(type) {
      if (type === "thumbnail") {
        this.$refs.thumbnail.click();
      } else {
        this.$refs.pdf.click();
      }
    },
    async upload(type) {
      if (type === "thumbnail") {
        this.form.thumbnail = this.$refs.thumbnail.files[0];
        this.thumbnail_url = URL.createObjectURL(this.form.thumbnail);
      } else {
        this.pdfloader = true;
        this.form.pdf = await this.$refs.pdf.files[0];
        this.pdfloader = false;
      }
    },
    reset() {
      this.form = {
        status: true
      };
    },
    async submit() {
      this.loading = true;
      try {
        const { data } = await this.$api.put(
          `/${this.type}/${this.$route.params.slug}`,
          this.form
        );
        this.success = "Successfully Updated " + this.type.toUpperCase();
      } catch (e) {
        this.error = e.response.data;
        this.validation_error = e;
      }
      this.loading = false;
    },
    async fetchData() {
      try {
        const { data } = await this.$api.get(
          `/${this.type}/${this.$route.params.slug}`
        );
        const { created_at, updated_at, id, ...others } = data;
        this.form = others;
      } catch (e) {
        console.log(e);
      }
    }
  },
  async mounted() {
    await this.fetchData();
    this.thumbnail_url = this.form.thumbnail;
  }
};
</script>