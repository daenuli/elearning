<template>
  <Layout pageTitle="Assessments">
    <PageHeader :breadcrumb_title="''" />
    <div class="container-fluid mt-3">
      <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
        <p>{{ $page.props.flash.success }}</p>
      </div>
      <div v-if="$page.props.flash.error" class="alert alert-danger" role="alert">
        <p>{{ $page.props.flash.error }}</p>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <h4><b>{{ assessment.title }}</b></h4>
                  Marks Obtained: {{ studentAssessment.marks_obtained }}
                </div>
                <div class="col-md-6">
                  <button class="btn btn-primary btn-sm pull-right" type="button" data-bs-toggle="modal"
                    data-bs-target="#gradeAssessment">
                    Grade Assessment
                  </button>
                  <Link class="btn btn-success mr-1 pull-right" :href="
                    route(
                      'teacher.evaluation.student.assessments',
                      assessment.id
                    )
                  ">
                  <i class="fa fa-caret-left white"></i> Back</Link>
                </div>
              </div>
              <div class="row mt-5">
                <div class="col-md-12">
                  <div v-for="(question, index) in questions" :key="index">
                    <div v-if="question.type === 'Multiple Choice'">
                      <p>Q: {{ question.text }}</p>
                      <ol class="mt-3">
                        <li v-for="(choice, index) in question.choices" :key="index">
                          <span :class="{
                            'badge badge-info': isCorrectChoice(choice),
                            'badge badge-success': isStudentChoiceCorrect(
                              question,
                              choice
                            ),
                          }">
                            {{ String.fromCharCode(65 + index) }}. {{ choice.text }}
                          </span>
                        </li>
                      </ol>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3>Essay Questions</h3>
            </div>
            <div class="card-body">
              <div v-for="question in questions" :key="question.id">
                <div class="row mt-5 b-b-info border-1" v-if="question.type === 'Essay'">
                  <div class="col-md-12">
                    <!-- <button class="btn btn-info pull-right">Enter Marks</button> -->
                    <p>Q: {{ question.text }}</p>
                    <p class="mt-5 mb-5" v-if="question.answer.essay_answer_text"
                      v-html="question.answer.essay_answer_text"></p>
                    <p v-else class="text-danger mb-5">
                      <i>The student has not provided an answer to this essay
                        question</i>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="gradeAssessment" tabindex="-1" role="dialog" aria-labelledby="gradeAssessment"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <form class="form theme-form" @submit.prevent="
              form.post(
                route(
                  'teacher.evaluation.student.assessment.grade',
                  studentAssessment.id
                )
              )
            ">
              <input type="hidden" v-model="form.id" />
              <div class="modal-header">
                <h5 class="modal-title" id="gradeAssessmentModal">
                  <i class="fa fa-star"></i>
                  Grade Assessment
                </h5>
                <button class="close" type="button" aria-label="Close" data-bs-dismiss="modal">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="alert alert-info  alert-dismissible fade show" role="alert">To streamline
                  the grading process, please note that only the essay questions require manual grading.
                  The multiple choice questions will be graded automatically. Kindly evaluate the essay
                  questions below.
                </div>
                <div class="mb-3 row">
                  <label class="col-sm-5 col-form-label">Marks Obtained (Only Essay Questions)</label>
                  <div class="col-sm-7">
                    <input v-model="form.marks" class="form-control form-control-sm"
                      :class="[errors.marks ? 'is-invalid' : '']" required type="text" />
                    <div class="txt-danger">{{ errors.marks }}</div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-light" type="button" data-bs-dismiss="modal">
                  Cancel
                </button>
                <button class="btn btn-primary" type="submit">Save</button>
              </div>
            </form>
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

export default {
  props: {
    assessment: Object,
    questions: Object,
    studentAssessment: Object,
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
  setup(props) {
    const isStudentChoiceCorrect = (question, choice) => {
      return question.answer.student_choice_id === choice.id;
    };

    const isCorrectChoice = (choice) => {
      return choice.is_correct;
    };

    const form = useForm({
      id: null,
      marks: props.studentAssessment.marks_obtained,
    });

    Inertia.on("success", (event) => {
      $("#gradeAssessment").modal("hide");
    });

    return {
      form,
      isStudentChoiceCorrect,
      isCorrectChoice,
    };
  },
};
</script>