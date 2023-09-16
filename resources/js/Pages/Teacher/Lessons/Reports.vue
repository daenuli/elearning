<template>
  <Layout :pageTitle="__('Lesson Reports')">
    <PageHeader :breadcrumb_title="__('Lesson Reports')" />
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300"><i class="fa fa-book"></i> {{ __('Lesson Reports') }}</h5>
              <div class="card-header-right">
                <a :href="route('teacher.export.lesson.reports', lesson.id)" class="btn btn-info btn-sm" title="Dwonload Report"> <i class="fa fa-download white"></i></a>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Student Name') }}</th>
                    <th scope="col">{{ __('Is present') }}?</th>
                    <th scope="col">{{ __('Access Date') }}</th>
                    <th scope="col">{{ __('Proggress (%)') }}</th>
                    <th scope="col">{{ __('Description') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(report, index) in reports" :key="report.id">
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ report.student_name }}</td>
                    <td>{{ report.formatted_date ? 'Yes' : 'No' }}</td>
                    <td>{{ report.formatted_date }}</td>
                    <td>{{ report.video_progress }}</td>
                    <td>{{ report.formatted_date ? 'taking lessons' : 'not attending lessons' }}</td>
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
    lesson: Object,
    reports: Object
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