<template>
  <Head :title="__('Assessments')" />
  <PageMainHeader />
  <div class="page-body-wrapper">
    <Sidebar />
    <div class="page-body">
      <div class="container-fluid">
        <PageHeader :breadcrumb_title="__('Assessments')" />
      </div>
      <div class="container-fluid mt-3">
        <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
          <p>{{ $page.props.flash.success }}</p>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5 class="f-w-300"><i class="fa fa-book"></i>{{ __('Assessments') }}</h5>
                <div class="card-header-right">
                  <Link :href="route('student.active-lessons.index')" class="pull-right white"><i
                    class="fa fa-caret-left white"></i>{{ __('Back') }}</Link>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3 row">
                      <label class="col-sm-5 col-form-label"><b>{{ __('FilterBy Subject') }}</b></label>
                      <div class="col-sm-7">
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
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th scope="col">Sr. No.</th>
                            <th scope="col">{{ __('Title') }}</th>
                            <th scope="col">{{ __('Subject') }}</th>
                            <th scope="col">{{ __('Due Date') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Result') }}</th>
                            <th scope="col">{{ __('Action') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(assessment, index) in assessmentsList" :key="assessment.id">
                            <th scope="row">{{ index + 1 }}</th>
                            <td> {{ assessment.title }}</td>
                            <td> {{ assessment.subject.title }}</td>
                            <td class="text-danger">{{ assessment.end_date }}</td>
                            <td><span
                                :class="['badge', isAssessmentCompleted(assessment) ? 'badge-success' : 'badge-warning']">{{
                                  isAssessmentCompleted(assessment) ? 'Submitted' : 'Pending' }}</span></td>
                            <td>{{ __('Score') }}: {{ assessment.status.marks_obtained }}</td>
                            <td>
                              <Link v-if="!(isAssessmentCompleted(assessment))"
                                :href="route('student.assessments.instructions', assessment.id)" class="btn btn-primary btn-xs">
                              {{ __('Start Assessment') }}
                              </Link>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <p class="text-center mt-3" v-if="!assessmentsList.length">
                        {{ __('No assessments found') }}.
                      </p>
                    </div>
                  </div>
                </div>
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
import PageHeader from "@/Pages/Student/Layout/PageHeader.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import moment from 'moment'
import { ref } from "vue";

export default {
  props: {
    subjects: Object,
    assessments: Object
  },
  components: {
    Link,
    Head,
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
    let assessmentsList = ref(props.assessments);
    let subject_id = ref('');

    const search = () => {
      if (subject_id.value) {
        axios.get(route('student.active-assessments.search'), { params: { subject_id: subject_id.value } }).then(response => {
          assessmentsList.value = [];
          assessmentsList.value = response.data;
        });
        return;
      }
      assessmentsList.value = props.assessments;
    };

    const isAssessmentCompleted = (assessment) => {
      return assessment.status.status === 'Completed';
    };

    return { isAssessmentCompleted, assessmentsList, subject_id, search }
  }
};
</script>