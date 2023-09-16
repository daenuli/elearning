<template>
  <Layout>
    <PageHeader :breadcrumb_title="__('Create Student')" />
    <div class="container-fluid">
      <form class="form theme-form" @submit.prevent="form.post(route('admin.students.store'))">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>{{ __('Create Student') }}</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Name') }}</label>
                      <div class="col-sm-9">
                        <input v-model="form.name" class="form-control form-control-sm"
                          :class="[errors.name ? 'is-invalid' : '']" type="text" />
                        <div class="txt-danger">{{ errors.name }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Email') }}</label>
                      <div class="col-sm-9">
                        <input v-model="form.email" class="form-control form-control-sm"
                          :class="[errors.email ? 'is-invalid' : '']" type="email" />
                        <div class="txt-danger">{{ errors.email }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Password') }}</label>
                      <div class="col-sm-9">
                        <input v-model="form.password" class="form-control form-control-sm"
                          :class="[errors.password ? 'is-invalid' : '']" type="password" />
                        <div class="txt-danger">{{ errors.password }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                      <div class="col-sm-9">
                        <input id="password_confirmation" v-model="form.password_confirmation"
                          class="form-control form-control-sm" :class="[errors.password_confirmation ? 'is-invalid' : '']"
                          type="password" />
                        <div class="txt-danger">{{ errors.password_confirmation }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('NISN') }}</label>
                      <div class="col-sm-9">
                        <input v-model="form.NISN_number" class="form-control form-control-sm"
                          :class="[errors.NISN_number ? 'is-invalid' : '']" type="text" />
                        <div class="txt-danger">{{ errors.NISN_number }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Place of Birth') }}</label>
                      <div class="col-sm-9">
                        <input v-model="form.place_of_birth" class="form-control form-control-sm"
                          :class="[errors.place_of_birth ? 'is-invalid' : '']" type="text" />
                        <div class="txt-danger">{{ errors.place_of_birth }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Date of Birth') }}</label>
                      <div class="col-sm-9">
                        <Datepicker v-model="form.date_of_birth" :enable-time-picker="false" auto-apply></Datepicker>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Gender') }}</label>
                      <div class="col-sm-9">
                        <select v-model="form.gender" class="form-control form-control-sm"
                          id="exampleFormControlSelect31">
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Religion') }}</label>
                      <div class="col-sm-9">
                        <input v-model="form.religion" class="form-control form-control-sm"
                          :class="[errors.religion ? 'is-invalid' : '']" type="text" />
                        <div class="txt-danger">{{ errors.religion }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Avatar') }}</label>
                      <div class="col-sm-9">
                        <input type="file" :class="[
                          errors.avatar ? 'is-invalid' : '',
                        ]" @input="form.avatar = $event.target.files[0]" />
                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                          {{ form.progress.percentage }}%
                        </progress>
                        <div class="txt-danger">
                          {{ errors.avatar }}
                        </div>
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
                            {{ school_class.name }}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Study Group') }}</label>
                      <div class="col-sm-9">
                        <select v-model="form.study_group_id" class="form-control form-control-sm"
                          id="exampleFormControlSelect31">
                          <option value="">({{ __('none') }})</option>
                          <option :value="study_group.id" v-for="study_group in study_groups" :key="study_group.id">
                            {{ study_group.name }}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <h1 style="font-size:25px"><b>{{ __('Address') }}</b></h1>
                <div class="row mt-3">
                  <div class="col-md-6">
                    <div class="row">
                      <label class="col-sm-3 col-form-label">{{ __('Road') }}</label>
                      <div class="col-sm-9">
                        <input v-model="form.road" class="form-control form-control-sm"
                          :class="[errors.road ? 'is-invalid' : '']" type="text" />
                        <div class="txt-danger">{{ errors.road }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Village') }}</label>
                      <div class="col-sm-9">
                        <input v-model="form.village" class="form-control form-control-sm"
                          :class="[errors.village ? 'is-invalid' : '']" type="text" />
                        <div class="txt-danger">{{ errors.village }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Subdistrict') }}</label>
                      <div class="col-sm-9">
                        <input v-model="form.subdistrict" class="form-control form-control-sm"
                          :class="[errors.subdistrict ? 'is-invalid' : '']" type="text" />
                        <div class="txt-danger">{{ errors.subdistrict }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('City') }}</label>
                      <div class="col-sm-9">
                        <input v-model="form.city" class="form-control form-control-sm"
                          :class="[errors.city ? 'is-invalid' : '']" type="text" />
                        <div class="txt-danger">{{ errors.city }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">{{ __('Province') }}</label>
                      <div class="col-sm-9">
                        <input v-model="form.province" class="form-control form-control-sm"
                          :class="[errors.province ? 'is-invalid' : '']" type="text" />
                        <div class="txt-danger">{{ errors.province }}</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer p-5">
                <button class="btn btn-sm btn-primary ml-1 pull-right" type="submit">
                  {{ __('Submit') }}
                </button>
                <Link :href="route('admin.students.index')" class="btn btn-sm btn-light pull-right">{{ __('Cancel') }}</Link>
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
    users: Object,
    errors: Object,
    classes: Object,
    study_groups: Object,
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
      name: "",
      email: "",
      password: "",
      class_id: "",
      study_group_id: "",
      password_confirmation: "",
      NISN_number: "",
      gender: "Male",
      religion: "",
      place_of_birth: "",
      date_of_birth: new Date(),
      road: "",
      village: "",
      subdistrict: "",
      city: "",
      province: "",
      date: new Date(),
      avatar: null
    });

    return { form };
  },
};
</script>