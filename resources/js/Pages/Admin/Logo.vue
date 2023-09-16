<template>
  <Layout pageTitle="Update Logo">
    <PageHeader :breadcrumb_title="'Update Logo'" />
    <div class="container-fluid mt-3">
      <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
        <p>{{ $page.props.flash.success }}</p>
      </div>
      <form class="form theme-form" @submit.prevent="submitForm">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="row mt-3">
                  <div class="col-md-6">
                    <label class="form-label">Logo</label>
                    <input type="file" :class="[errors.logo ? 'is-invalid' : '']"
                      @input="form.logo = $event.target.files[0]" />
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                      {{ form.progress.percentage }}%
                    </progress>
                    <div class="txt-danger">
                      {{ errors.logo }}
                    </div>
                  </div>
                </div>
                <div class="form-footer">
                  <button type="submit" class="btn btn-primary mt-3 pull-right">
                    {{ __('Save') }}
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </Layout>
</template>
<script>
import { Link, useForm, Head } from "@inertiajs/inertia-vue3";
import Sidebar from "@/Pages/Admin/Layout/Sidebar.vue";
import Layout from "@/Pages/Admin/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Admin/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Admin/Layout/PageHeader.vue";
import image from "@/assets/img/logo.jpg";
import { Inertia } from '@inertiajs/inertia'

export default {
  props: {
    user: Object,
    errors: Object,
    logo: String | Boolean,
  },
  data() {
    return {
      image: image,
    };
  },
  name: "profile",
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
  },
  setup() {
    const form = useForm({
      logo: null,
    });
   
    return { form };
  },

  methods: {
    async submitForm() {
      // make API request
      await this.$inertia.post('/admin/logo', this.form)

      // register success event listener
      Inertia.on('success', (event) => {
        console.log(event);
        location.reload(true);
      })
    }
  }
};
</script>