<template>
  <Layout :pageTitle="__('Details')">
    <PageHeader :breadcrumb_title="__('Details')" />
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300">{{ __('Student Details') }}</h5>
              <div class="card-header-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <Link :href="route('admin.students.edit', student.id)" class="btn btn-xs btn-primary"><i
                    class="fa fa-pencil text-white"></i>{{ __('Edit') }}</Link>
                  <Link :href="route('admin.students.index')" class="btn btn-xs btn-success"><i
                    class="fa fa-arrow-left text-white"></i> {{ __('Back to list') }}</Link>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="avatars mb-3 text-center" v-if="avatar">
                <div class="avatar"><img class="img-70 rounded-circle" :src="avatar"></div>
              </div>
              <div class="table-responsive">
                <table class="table table-sm table-bordered">
                  <tr>
                    <th>{{ __('Name') }}</th>
                    <td>{{ student.name }}</td>
                    <th>{{ __('Email') }}</th>
                    <td><a :href="`mailto:${student.email}`" class="txt-primary">{{ student.email }}</a></td>
                  </tr>
                  <tr>
                    <th>{{ __('Date of Birth') }}</th>
                    <td>{{ student.date_of_birth }}</td>
                    <th>{{ __('Gender') }}</th>
                    <td>{{ student.gender }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Religion') }}</th>
                    <td>{{ student.religion }}</td>
                    <th>{{ __('Place of Birth') }}</th>
                    <td>{{ student.place_of_birth }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Class') }}</th>
                    <td>{{ student.school_class.name }}</td>
                    <th>{{ __('Study Group') }}</th>
                    <td>{{ student.study_group.name }}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300">{{ __('Address') }}</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-sm table-bordered">
                  <tr>
                    <th>{{ __('Road') }}</th>
                    <td>{{ student.road }}</td>
                    <th>{{ __('Village') }}</th>
                    <td>{{ student.village }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Subdistrict') }}</th>
                    <td>{{ student.subdistrict }}</td>
                    <th>{{ __('City') }}</th>
                    <td>{{ student.city }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Province') }}</th>
                    <td>{{ student.province }}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
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
import { Link, Head } from "@inertiajs/inertia-vue3";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

export default {
  props: {
    avatar: String | Boolean,
    student: Object,
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
};
</script>