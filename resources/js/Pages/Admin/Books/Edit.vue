<template>
  <Layout :pageTitle="__('Edit Book')">
    <PageHeader :breadcrumb_title="__('Edit Book')" />
    <div class="container-fluid">
      <form class="form theme-form" @submit.prevent="form.patch(route('admin.books.update', book.id))">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="f-w-300"><i class="fa fa-book"></i> {{ __('Edit Book') }}</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Title') }}</label>
                      <div class="col-sm-9">
                        <input v-model="form.title" class="form-control form-control-sm"
                          :class="[errors.title ? 'is-invalid' : '']" type="text" placeholder="Title" />
                        <div class="txt-danger">{{ errors.title }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Subject') }}</label>
                      <div class="col-sm-9">
                        <select
                          v-model="form.subject_id"
                          class="form-control form-control-sm"
                          id="exampleFormControlSelect31"
                        >
                          <option value="null">({{ __('none') }})</option>
                          <option
                            :value="subject.id"
                            v-for="subject in subjects"
                            :key="subject.id"
                          >
                            {{ subject.title }}
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Class') }}</label>
                      <div class="col-sm-9">
                        <select v-model="form.class_id" class="form-control form-control-sm"
                          id="exampleFormControlSelect31">
                          <option value="">({{ __('none') }})</option>
                          <option :value="school_class.id" v-for="school_class in classes" :key="school_class.id">
                            {{ school_class.name }}
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Upload Book PDF') }}</label>
                      <div class="col-sm-9">
                        <input class="pl-2" type="file" :class="[errors.file ? 'is-invalid' : '']"
                          @input="form.file = $event.target.files[0]" />
                        <div class="txt-danger">
                          {{ errors.file }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button class="btn btn-sm btn-primary ml-1 pull-right" type="submit">
                  {{ __('Submit') }}
                </button>
                <Link :href="route('admin.books.index')" class="btn btn-sm btn-light pull-right">{{ __('Cancel') }}</Link>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </Layout>
</template>
<script>
import Sidebar from "@/Pages/Admin/Layout/Sidebar.vue";
import Layout from "@/Pages/Admin/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Admin/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Admin/Layout/PageHeader.vue";
import { Link, useForm, Head } from "@inertiajs/inertia-vue3";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

export default {
  props: {
    subjects: Object,
    classes: Object,
    book: Object,
    errors: Object,
  },
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    Datepicker,
    PageMainHeader,
  },
  setup(props) {
    const form = useForm({
      title: props.book.title,
      subject_id: props.book.subject_id,
      class_id: props.book.class_id,
      file: '',
    });
    return { form };
  },
};
</script>