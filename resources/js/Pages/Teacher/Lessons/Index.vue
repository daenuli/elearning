<template>
  <Layout :pageTitle="__('Lessons')">
    <PageHeader :breadcrumb_title="__('Lessons')" />
    <div class="container-fluid">
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
              <h5 class="f-w-300"><i class="fa fa-book"></i> {{ __('Lessons') }}</h5>
              <div class="card-header-right">
                <Link :href="route('teacher.lessons.create')" class="btn btn-light btn-sm">
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
                    <th scope="col">{{__('Title')}}</th>
                    <th scope="col">{{__('Class')}}</th>
                    <th scope="col">{{__('Study Group')}}</th>
                    <th scope="col">{{__('Subject')}}</th>
                    <th scope="col">{{__('Schedule From')}}</th>
                    <th scope="col">{{__('Schedule To')}}</th>
                    <th scope="col">{{__('Actions')}}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(lesson, index) in lessons" :key="lesson.id">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ lesson.title }}</td>
                    <td>{{ lesson.class.name }}</td>
                    <td>{{ lesson.study_group.name }}</td>
                    <td>{{ lesson.subject.title }}</td>
                    <td>{{ lesson.start_date }}</td>
                    <td>{{ lesson.end_date }}</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <!-- <a :href="route('teacher.export.lesson.reports', lesson.id)" class="btn btn-info btn-xs" title="Dwonload Report"><i class="fa fa-download"></i></a> -->
                        <Link :href="route('teacher.lessons.reports', lesson.id)" class="btn btn-info btn-xs" title="View Reports">
                          <i class="fa fa-file-excel-o"></i>
                        </Link>
                        <Link :href="route('teacher.lessons.show', lesson.id)" class="btn btn-success btn-xs" title="View">
                        <i class="fa fa-eye"></i>
                        </Link>
                        <Link :href="route('teacher.lessons.edit', lesson.id)" class="btn btn-info btn-xs" title="Edit">
                        <i class="fa fa-pencil"></i>
                        </Link>
                        <button @click="destroy(lesson)" class="btn btn-danger btn-xs" title="Delete"><i class="fa fa-trash"></i>
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
import Sidebar from "@/Pages/Teacher/Layout/Sidebar.vue";
import Layout from "@/Pages/Teacher/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Teacher/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Teacher/Layout/PageHeader.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';
import Swal from 'sweetalert2'
import moment from 'moment'

export default {
  props: {
    lessons: Object
  },
  name: "admin-layout",
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
    const destroy = (lesson) => {

      Swal.fire({
        title: 'Are you sure?',
        text: `Do you want to delete lesson ${lesson.title}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete!'
      }).then((result) => {
        if (result.isConfirmed) {
          Inertia.delete(route('teacher.lessons.destroy', lesson.id));
        }
      })
    }

    return { destroy }
  }
};
</script>