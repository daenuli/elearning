<template>
  <Layout :pageTitle="'Import Students'">
    <PageHeader :breadcrumb_title="__('Import Students')" />
    <div class="container-fluid">
      <div v-if="$page.props.flash.error" class="alert alert-danger" role="alert">
        <p>{{ $page.props.flash.error }}</p>
      </div>
      <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
        <p>{{ $page.props.flash.success }}</p>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <form class="form theme-form" @submit.prevent="form.post(route('admin.import.students.store'))">
            <div class="card">
              <div class="card-header">
                <h5>{{ __('Import Students') }}</h5>
                <div class="card-header-right">
                  <Link :href="route('admin.students.index')
                    " class="btn btn-light mr-2">
                  <i class="fa fa-caret-left"></i> {{ __('Back') }}
                  </Link>
                </div>
              </div>
              <div class="card-body">
                <div class="alert alert-info dark alert-dismissible fade show" role="alert"><strong>{{ __('Note')
                }}:</strong> {{ __('Make sure to reset file field after making changes to the file.') }}</div>
                <div class="mb-3 row">
                  <label class="col-sm-2 col-form-label">{{ __('Choose File') }} (xlsx, csv)</label>
                  <div class="col-sm-10">
                    <input type="file" ref="file" name="import" id="import" :class="[errors.file ? 'is-invalid' : '']"
                      @input="uploadFile($event)" :key="fileInputKey" accept=".xlsx">
                    <div class="txt-danger">{{ errors.file }}</div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div v-if="$page.props.flash.import_error" class="alert alert-warning" role="alert">
                      <h4>Import validation errors.</h4>
                      <ul>
                        <li v-for="error in $page.props.flash.import_error" :key="error.name">
                          {{ error[0] }}
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button class="btn btn-success pull-right ml-2" :disabled="importing"><i class="fa fa-download"></i>
                  {{ __('Import') }}</button>
                <button class="btn btn-info pull-right" type="button" @click="resetFileInput"><i
                    class="fa fa-refresh"></i> {{ __('Reset') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </Layout>
</template>
<script>

import Sidebar from "@/Pages/Admin/Layout/Sidebar.vue";
import Layout from "@/Pages/Admin/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Admin/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Admin/Layout/PageHeader.vue";
import { Link, useForm, Head } from "@inertiajs/inertia-vue3";
import { ref } from 'vue'
import { Inertia } from "@inertiajs/inertia";

export default {
  props: {
    errors: Object,
  },
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
  },
  setup() {
    let fileInputKey = ref(0);
    let importing = ref(false);

    const form = useForm({
      file: null,
    });

    const uploadFile = ($event) => {
      form.file = $event.target.files[0];
    };

    Inertia.on('start', (event) => {
      importing.value = true;
    })

    Inertia.on('success', (event) => {
      importing.value = false;
    })

    Inertia.on('error', (error) => {
      importing.value = false;
    })

    const resetFileInput = () => {
      form.file = null;
      document.getElementById('import').value = []
    };

    return { fileInputKey, form, resetFileInput, uploadFile, importing };
  },
};
</script>