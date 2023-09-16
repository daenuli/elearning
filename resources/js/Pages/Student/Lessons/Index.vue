<template>
  <Head :title="__('Active Lessons')" />
  <PageMainHeader />
  <div class="page-body-wrapper">
    <Sidebar />
    <div class="page-body">
      <div class="container-fluid">
        <PageHeader :breadcrumb_title="__('Active Lessons')" />
      </div>
      <div class="container-fluid ">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <div class="mb-3 row">
              <label class="col-form-label"><b>{{ __('FilterBy Subject') }}</b></label>
              <select v-model="subject_id" @change="search" class="form-control form-control-sm"
                id="exampleFormControlSelect31">
                <option value=""> ({{ __('All Subjects') }})</option>
                <option :value="subject.id" v-for="subject in subjects" :key="subject.id">
                  {{ subject.title }}
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="row" v-if="lessonsList.length">
          <div class="col-sm-4" v-for="lesson in lessonsList" :key="lesson.id">
            <div class="card">
              <div class="card-header">
                <h6 class="f-w-300 text-left">
                  {{ lesson.title }}
                </h6>
                <Link :href="route('student.lessons.show', lesson.id)" class="btn btn-primary btn-sm">
                {{ __('Start Lesson') }} <i class="fa fa-angle-double-right white"></i></Link>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-sm">
                    <tr>
                      <th>{{ __('Due Date') }}</th>
                      <td class="text-danger">{{ lesson.end_date }}</td>
                    </tr>
                    <tr>
                      <th>{{ __('Subject') }}</th>
                      <td>
                        {{ lesson.subject.title }}
                      </td>
                    </tr>
                    <tr>
                      <th>{{ __('Files') }}</th>
                      <td>
                        <a href="" data-bs-toggle="modal" :data-bs-target="`.lesson-files-${lesson.id}`">
                          <i class="fa fa-files-o"></i> Files
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <th>{{ __('Discussion') }}</th>
                      <td>
                        <Link :href="route('student.lessons.discussion.index', lesson.id)">
                        <i class="fa fa-users"></i> {{ __('Discussion') }}
                        </Link>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal fade" :class="`lesson-files-${lesson.id}`" tabindex="-1" role="dialog"
              aria-labelledby="mySmallModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="mySmallModalLabel">Files</h4>
                    <button class="close" type="button" aria-label="Close" data-bs-dismiss="modal"><span
                        aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body text-center">
                    <p v-if="lesson.files.length === 0" style="color:gray">No files found!</p>
                    <p v-else v-for="file in lesson.files" :key="file.name">
                      <a :href="file.url" download>{{ file.name }}</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row" v-else>
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <p class="text-center">No lessons found.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Sidebar from "@/Pages/Student/Layout/Sidebar.vue";
import PageMainHeader from "@/Pages/Student/Layout/PageMainHeader.vue";
import Layout from "@/Pages/Student/Layout/Layout.vue";
import PageHeader from "@/Pages/Student/Layout/PageHeader.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia';
import Swal from 'sweetalert2'
import moment from 'moment'
import { ref } from 'vue'

export default {
  props: {
    subjects: Object,
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
  setup(props) {
    let lessonsList = ref(props.lessons);
    let subject_id = ref('');

    const search = () => {
      if (subject_id.value) {
        axios.get(route('student.active-lessons.search'), { params: { subject_id: subject_id.value } }).then(response => {
          lessonsList.value = [];
          lessonsList.value = response.data;
        });
        return;
      }
      lessonsList.value = props.lessons;
    };

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
          Inertia.delete(route('student.lessons.destroy', lesson.id));
        }
      })
    }

    return { destroy, subject_id, search, lessonsList }
  }
};
</script>