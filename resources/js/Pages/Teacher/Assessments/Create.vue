<template>
  <Layout :pageTitle="__('Create Assessment')">
    <PageHeader :breadcrumb_title="__('Create Assessment')" />
    <div class="container-fluid">
      <form class="form theme-form" @submit.prevent="form.post(route('teacher.assessments.store'))">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="f-w-300">
                  <i class="fa fa-book"></i>{{ __('Create Assessment') }}
                </h5>
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
                      <label class="col-sm-3 col-form-label">{{ __("Time limit") }} ({{ __('In minutes') }})</label>
                      <div class="col-sm-9">
                        <input v-model.number="form.time_limit_in_minutes" class="form-control form-control-sm"
                          :class="[errors.time_limit_in_minutes ? 'is-invalid' : '']" type="number"
                          :placeholder="__('Enter time limit')" />
                        <div class="txt-danger">{{ errors.time_limit_in_minutes }}</div>
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
                        <Datepicker v-model="form.end_date" :class="[errors.end_date ? 'is-invalid' : '']"
                          :enable-time-picker="false" auto-apply></Datepicker>
                        <div class="txt-danger">{{ errors.end_date }}</div>
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
                        <select v-model="form.study_group_id" class="form-control form-control-sm" :class="[
                          errors.study_group_id ? 'is-invalid' : '',
                        ]" id="exampleFormControlSelect31">
                          <option value="">({{ __('none') }})</option>
                          <option :value="study_group.id" v-for="study_group in study_groups" :key="study_group.id">
                            {{ study_group.name }}
                          </option>
                        </select>
                        <div class="txt-danger">
                          {{ errors.study_group_id }}
                        </div>
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
              <div class="card-footer">
                <button class="btn btn-sm btn-primary ml-1 pull-right" type="submit">
                  {{ __('Submit') }}
                </button>
                <Link :href="route('teacher.assessments.index')" class="btn btn-sm btn-light pull-right">{{ __('Cancel') }}</Link>
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
    Sidebar,
    PageHeader,
    Datepicker,
    PageMainHeader,
  },
  setup() {
    const form = useForm({
      class_id: "",
      study_group_id: "",
      subject_id: null,
      title: "",
      time_limit_in_minutes: "",
      start_date: new Date(),
      end_date: new Date(),
    });
    return { form };
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