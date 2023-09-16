<template>
  <Layout :pageTitle="__('Create Assignment')">
    <PageHeader :breadcrumb_title="__('Create Assignment')" />
    <div class="container-fluid">
      <form class="form theme-form" @submit.prevent="form.post(route('teacher.assignments.store'))">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="f-w-300"><i class="fa fa-book"></i>{{ __('Create Assignment') }}</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Title') }}</label>
                      <div class="col-sm-9">
                        <input v-model="form.title" class="form-control form-control-sm"
                          :class="[errors.title ? 'is-invalid' : '']" type="text" :placeholder="__('Title')" />
                        <div class="txt-danger">{{ errors.title }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Files') }}</label>
                      <div class="col-sm-9">
                        <input type="file" multiple :class="[errors.files ? 'is-invalid' : '']" @input="uploadFiles" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                          {{ form.progress.percentage }}%
                        </progress>
                        <div class="txt-danger" v-for="(error, i) in Object.keys(errors)" :key="i">
                          <p v-if="error.includes('files')">{{ errors[error] }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Schedule From') }}</label>
                      <div class="col-sm-9">
                        <Datepicker v-model="form.start_date" :enable-time-picker="false" auto-apply></Datepicker>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Schedule To') }}</label>
                      <div class="col-sm-9">
                        <Datepicker v-model="form.end_date" :enable-time-picker="false" auto-apply></Datepicker>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Class') }}</label>
                      <div class="col-sm-9">
                        <select v-model="form.class_id" class="form-control form-control-sm"
                          :class="[errors.class_id ? 'is-invalid' : '']" id="exampleFormControlSelect31">
                          <option value="">({{ __('none') }})</option>
                          <option :value="school_class.id" v-for="school_class in classes" :key="school_class.id">
                            {{ school_class.name }}
                          </option>
                        </select>
                        <div class="txt-danger">{{ errors.class_id }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Study Group') }}</label>
                      <div class="col-sm-9">
                        <select v-model="form.study_group_id" class="form-control form-control-sm"
                          :class="[errors.study_group_id ? 'is-invalid' : '']" id="exampleFormControlSelect31">
                          <option value="">({{ __('none') }})</option>
                          <option :value="study_group.id" v-for="study_group in study_groups" :key="study_group.id">
                            {{ study_group.name }}
                          </option>
                        </select>
                        <div class="txt-danger">{{ errors.study_group_id }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Subject') }}</label>
                      <div class="col-sm-9">
                        <select v-model="form.subject_id" class="form-control btn-square digits" :class="[
                          errors.subject_id ? 'is-invalid' : '',
                        ]" id="subject">
                          <option value="null">({{ __('none') }})</option>
                          <option :value="subject.id" v-for="subject in subjects" :key="subject.id">
                            {{ subject.title }}
                          </option>
                        </select>
                        <div class="txt-danger">
                          {{ errors.subject_id }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>{{ __('Instructions') }}</h5>
              </div>
              <div class="card-body">
                <editor v-model="form.instructions" api-key="6g685dmceoqy8iip7a7dfmn0z3u4m9k1iwt89isp9jai9yy6" :init="{
                  theme: 'silver',
                  plugins: plugins,
                  toolbar: toolbar,
                  content_style: content_style,
                }" />
              </div>
              <div class="card-footer p-5">
                <button class="btn btn-sm btn-primary ml-1 float-right" type="submit">
                  {{__('Submit')}}
                </button>
                <Link :href="route('teacher.assignments.index')" class="btn btn-sm btn-light float-right">{{ __('Cancel') }}
                </Link>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </Layout>
</template>
<script>
import Sidebar from "@/Pages/Teacher/Layout/Sidebar.vue";
import Layout from "@/Pages/Teacher/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Teacher/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Teacher/Layout/PageHeader.vue";
import { Link, useForm, Head } from "@inertiajs/inertia-vue3";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import Editor from '@tinymce/tinymce-vue';

export default {
  props: {
    subjects: Object,
    classes: Object,
    study_groups: Object,
    errors: Object,
  },
  components: {
    Link,
    Head,
    Layout,
    Editor,
    Sidebar,
    PageHeader,
    Datepicker,
    PageMainHeader,
  },
  setup() {
    const plugins = [
      "advlist",
      "autolink",
      "lists",
      "link",
      "image",
      "charmap",
      "preview",
      "anchor",
      "searchreplace",
      "visualblocks",
      "code",
      "fullscreen",
      "insertdatetime",
      "media",
      "table",
      "wordcount",
      "visualchars",
    ];
    const toolbar =
      "h1 h2 h3 h4 h5 h6 | undo redo | styles | bold italic underline| alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | fullscreen preview |";
    const content_style =
      "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }";
    const form = useForm({
      class_id: "",
      study_group_id: "",
      subject_id: null,
      title: "",
      instructions: "",
      file_name: "",
      files: [],
      start_date: new Date(),
      end_date: new Date(),
    });
    function uploadFiles($event) {
      form.files = $event.target.files;
    };
    return { form, uploadFiles, plugins, toolbar, content_style };
  },
};
</script>

<style>
.ck-editor__editable {
  min-height: 500px;
}

.ck-content .table {
  width: auto;
}
</style>