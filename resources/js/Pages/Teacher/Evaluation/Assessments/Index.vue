<template>
  <Layout pageTitle="Assessment Submissions">
    <PageHeader :breadcrumb_title="'Assessment Submissions'" />
    <div class="container-fluid mt-3">
      <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
        <p>{{ $page.props.flash.success }}</p>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300">
                <i class="fa fa-book"></i> {{ assessment.title }}
              </h5>
              <p>{{ assessment.subject.title }}</p>
              <div class="card-header-right">
                <a :href="route('teacher.export.assessments', assessment.id)" class="btn btn-success btn-sm mr-2">
                  <i class="fa fa-cloud-download white"></i>
                  Export
                </a>
                <Link :href="route('teacher.evaluation.assessments')" class="btn btn-info btn-sm mr-2 white"><i
                  class="fa fa-caret-left white"></i>Back</Link>
              </div>
            </div>
            <div class="table-responsive mt-3">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th scope="col">Student Name</th>
                    <th scope="col">Submitted</th>
                    <th scope="col">Submitted At</th>
                    <th scope="col">Marks Obtained</th>
                    <th scope="col">Is Graded</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="student in students" :key="student.id">
                    <td>{{ student.name }}</td>
                    <td>
                      <span :class="[
                        'badge',
                        isAssessmentCompleted(student)
                          ? 'badge-success'
                          : 'badge-danger',
                      ]">
                        {{ isAssessmentCompleted(student) ? "Yes" : "No" }}
                      </span>
                    </td>
                    <td>
                      {{ student.status.submittedAtDate }}
                    </td>
                    <td>{{ student.status.marks_obtained }}</td>
                    <td>
                      <span :class="[
                        'badge',
                        isAssessmentGraded(student)
                          ? 'badge-success'
                          : 'badge-danger',
                      ]">
                        {{ isAssessmentGraded(student) ? "Yes" : "No" }}
                      </span>
                    </td>
                    <td>
                      <Link :href="route(
                        'teacher.evaluation.student.assessment.review',
                        student.status.id
                      )
                        " class="btn btn-info" :class="{ 'disabled': isAssessmentGraded(student) }">
                      <i class="fa fa-clipboard"></i> Review
                      </Link>
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
import PageMainHeader from "@/Pages/Teacher/Layout/PageMainHeader.vue";
import Layout from "@/Pages/Teacher/Layout/Layout.vue";
import PageHeader from "@/Pages/Teacher/Layout/PageHeader.vue";
import { Link, useForm, Head } from "@inertiajs/inertia-vue3";
import moment from "moment";
import { Inertia } from "@inertiajs/inertia";
import { computed } from "vue";

export default {
  props: {
    students: Object,
    assessment: Object,
    errors: Object,
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
  setup() {
    const form = useForm({
      id: null,
      marks: 0,
    });

    const isAssessmentCompleted = (student) => {
      return student.status.status === 'Completed';
    };

    const isAssessmentGraded = (student) => {
      return student.status.is_graded;
    };

    function setForm(student) {
      form.id = student.id;
      form.marks = student.status.marks_obtained;
    }

    Inertia.on("success", (event) => {
      form.marks = 0;
      $(`#gradeAssessment${form.id}`).modal("hide");
    });
    return { form, setForm, isAssessmentCompleted, isAssessmentGraded };
  },
};
</script>