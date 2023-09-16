<template>
  <Layout :pageTitle="'Students'">
    <PageHeader :breadcrumb_title="__('Students')" />
    <div class="container-fluid">
      <div v-if="$page.props.flash.import_error" class="alert alert-warning" role="alert">
        <h4>Students import failed.</h4>
        <ul>
          <li v-for="error in $page.props.flash.import_error" :key="error.name">
            {{ error[0] }}
          </li>
        </ul>
      </div>
      <div v-if="$page.props.flash.error" class="alert alert-danger" role="alert">
        <p>{{ $page.props.flash.error }}</p>
      </div>
      <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
        <p>{{ $page.props.flash.success }}</p>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>{{ __('Students') }}</h5>
              <div class="card-header-right">
                <a :href="route('admin.export.students')" class="btn btn-success btn-sm mr-2">
                  <i class="fa fa-cloud-download white"></i>
                  {{ __('Export') }}
                </a>
                <Link :href="
                  route('admin.import.students.index')
                " class="btn btn-primary mr-2">
                <i class="fa fa-cloud-upload white"></i> {{ __('Import') }}
                </Link>
                <Link :href="route('admin.students.create')" class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i>
                {{ __('Create') }}
                </Link>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Email') }}</th>
                    <th scope="col">{{ __('NISN') }}</th>
                    <th scope="col">{{ __('Class') }}</th>
                    <th scope="col">{{ __('Study Group') }}</th>
                    <th scope="col">{{ __('Date of Birth') }}</th>
                    <th scope="col">{{ __('Actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(user, index) in users.data" :key="user.id">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ user.name }}</td>
                    <td>
                      <a :href="`mailto:${user.email}`" class="txt-primary">{{ user.email }}</a>
                    </td>
                    <td>{{ user.student.NISN_number }}</td>
                    <td>{{ user.student.school_class.name }}</td>
                    <td>{{ user.student.study_group.name }}</td>
                    <td>
                      {{ forramttedDate(user.student.date_of_birth) }}
                    </td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <Link :href="
                          route('admin.students.show', user.student.id)
                        " class="btn btn-success btn-xs">
                        <i class="fa fa-eye"></i>
                        </Link>
                        <Link :href="
                          route('admin.students.edit', user.student.id)
                        " class="btn btn-info btn-xs">
                        <i class="fa fa-pencil"></i>
                        </Link>
                        <button @click="destroy(user.id)" class="btn btn-danger btn-xs">
                          <i class="fa fa-trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
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
import { Inertia } from "@inertiajs/inertia";
import Swal from "sweetalert2";
import moment from "moment";

export default {
  props: {
    errors: Object,
    users: Object,
  },
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
    moment,
  },
  methods: {
    forramttedDate: function (date) {
      return moment(date).format("MMM D YYYY");
    },
  },
  setup() {
    const destroy = (id) => {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want to delete this student?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete!",
      }).then((result) => {
        if (result.isConfirmed) {
          Inertia.delete(route("admin.students.destroy", id));
        }
      });
    };

    return { destroy };
  },
};
</script>