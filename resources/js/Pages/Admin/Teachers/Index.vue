<template>
  <Layout pageTitle="Teachers">
    <PageHeader :breadcrumb_title="__('Teachers')" />
    <div class="container-fluid">
      <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
        <p>{{ $page.props.flash.success }}</p>
      </div>
      <div v-if="$page.props.flash.warning" class="alert alert-warning" role="alert">
        <p>{{ $page.props.flash.warning }}</p>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>{{ __('Teachers') }}</h5>
              <div class="card-header-right">
                <a :href="route('admin.export.teachers')" class="btn btn-success btn-sm mr-2">
                  <i class="fa fa-cloud-download white"></i>
                {{ __('Export') }}
                </a>
                <Link :href="
                  route('admin.import.teachers.index')
                " class="btn btn-primary mr-2">
                <i class="fa fa-cloud-upload white"></i> {{ __('Import') }}
                </Link>
                <Link :href="route('admin.teachers.create')" class="btn btn-light btn-sm">
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
                    <th scope="col">{{ __('Education') }}</th>
                    <th scope="col">{{ __('Gender') }}</th>
                    <th scope="col">{{ __('Religion') }}</th>
                    <th scope="col">{{ __('Appointment Decree') }}</th>
                    <th scope="col">{{ __('TMT: Date') }}</th>
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
                    <td>{{ user.teacher.education }}</td>
                    <td>{{ user.teacher.gender }}</td>
                    <td>{{ user.teacher.religion }}</td>
                    <td>{{ user.teacher.appointment_decree }}</td>
                    <td>{{ forramttedDate(user.teacher.date) }}</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <Link :href="route('admin.teachers.show', user.teacher.id)" class="btn btn-success btn-xs">
                        <i class="fa fa-eye"></i>
                        </Link>
                        <Link :href="route('admin.teachers.edit', user.teacher.id)" class="btn btn-info btn-xs">
                        <i class="fa fa-pencil"></i>
                        </Link>
                        <button @click="destroy(user)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
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
import { Link, useForm, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';
import Swal from 'sweetalert2'
import moment from 'moment'
import {getCurrentInstance, onMounted, toRefs} from 'vue'

export default {
  props: {
    users: Object
  },
  name: "create-teacher",
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
    moment
  },
  methods: {
    forramttedDate: function (date) {
      return moment(date).format('MMM D YYYY')
    }
  },
  setup() {
    const destroy = (user) => {
      Swal.fire({
        title: 'Are you sure?',
        text: `Do you want to delete ${user.name}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete!'
      }).then((result) => {
        if (result.isConfirmed) {
          Inertia.delete(route('admin.teachers.destroy', user.id));
        }
      })
    }

    return { destroy}
  }
};
</script>