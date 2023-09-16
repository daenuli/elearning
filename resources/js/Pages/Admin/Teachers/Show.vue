<template>
  <Layout :pageTitle="'Details'">
    <PageHeader :breadcrumb_title="__('Details')" />
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300">{{ __('Teacher Details') }}</h5>
              <div class="card-header-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <Link :href="route('admin.teachers.edit', teacher.id)" class="btn btn-xs btn-primary"><i
                    class="fa fa-pencil text-white"></i>{{ __('Edit') }}</Link>
                  <Link :href="route('admin.teachers.index')" class="btn btn-xs btn-success"><i
                    class="fa fa-arrow-left text-white"></i>{{ __('Back to list') }}</Link>
                </div>
              </div>
            </div>
            <div class="card-body avatar-showcase">
              <div class="avatars" v-if="avatar">
                <div class="avatar"><img class="img-100 rounded-circle" :src="avatar"></div>
              </div>
              <div class="table-responsive">
                <table class="table table-sm table-bordered">
                  <tr>
                    <th>{{ __('Name') }}</th>
                    <td>{{ teacher.name }}</td>
                    <th>{{ __('Email') }}</th>
                    <td><a :href="`mailto:${teacher.email}`" class="txt-primary">{{ teacher.email }}</a></td>
                  </tr>
                  <tr>
                    <th>{{ __('Education') }}</th>
                    <td>{{ teacher.education }}</td>
                    <th>{{ __('Gender') }}</th>
                    <td>{{ teacher.gender }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Religion') }}</th>
                    <td>{{ teacher.religion }}</td>
                    <th>{{ __('Appointment Decree') }}</th>
                    <td>{{ teacher.appointment_decree }}</td>
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
                    <td>{{ teacher.road }}</td>
                    <th>{{ __('Village') }}</th>
                    <td>{{ teacher.village }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Subdistrict') }}</th>
                    <td>{{ teacher.subdistrict }}</td>
                    <th>{{ __('City') }}</th>
                    <td>{{ teacher.city }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Province') }}</th>
                    <td>{{ teacher.province }}</td>
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
    teacher: Object,
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