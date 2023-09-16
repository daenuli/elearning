<template>
  <Layout :pageTitle="__('Home')" :avatar="avatar">
    <PageHeader :breadcrumb_title="__('Home')" />
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-xl-4">
          <div class="row">
            <div class="col-6">
              <h6 style="font-family: 'Poppins', sans-serif; color: #838383; font-size: 15px !important">
                <b>{{ __('Active Lessons') }}</b>
              </h6>
            </div>
            <div class="col-6">
              <Link :href="route('student.active-lessons.index')" class="btn btn-light pull-right p-10"><b>{{ __('Show all') }}</b></Link>
            </div>
          </div>
          <div class="row mt-3" v-if="lessons.length">
            <div v-for="(lesson, index) in lessons" :key="index" class="col-md-12">
              <div class="card">
                <div class="card-body" style=" cursor: pointer; padding: 15px 30px 5px 30px !important;">
                  <div class="chart-widget-dashboard">
                    <Link :href="route('student.lessons.show', lesson.id)">
                    <div class="media">
                      <div class="media-body">
                        <h6 class="f-w-600">
                          <p><span class="text-danger">{{ __('Due Date') }}: </span>{{ lesson.end_date }}</p>
                        </h6>
                        <h6 style="color: gray">
                          <b>{{ lesson.title }}</b>
                        </h6>
                      </div>
                      <i data-feather="tag"></i>
                      <i class="mt-4 icofont icofont-simple-right"></i>
                    </div>
                    </Link>
                    <div class="dashboard-chart-container">
                      <div class="small-chart-gradient-1"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-else>
            <div class="row mt-3">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <p class="text-center"><i>{{ __('No lesson is pending for your class') }}.</i></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="row">
            <div class="col-6">
              <h6 style="font-family: 'Poppins', sans-serif; color: #838383; font-size: 15px !important">
                <b>{{ __('Pending Assignments') }}</b>
              </h6>
            </div>
            <div class="col-6">
              <Link :href="route('student.assignments.index')" class="btn btn-light pull-right p-10"><b>{{ __('Show all') }}</b></Link>
            </div>
          </div>
          <div class="row mt-3" v-if="pendingAssignments.length">
            <div v-for="(assignment, index) in pendingAssignments" :key="index" class="col-md-12">
              <div class="card">
                <div class="card-body" style=" cursor: pointer; padding: 15px 30px 5px 30px !important;">
                  <div class="chart-widget-dashboard">
                    <Link :href="route('student.assignment.show', assignment.id)">
                    <div class="media">
                      <div class="media-body">
                        <h6 class="f-w-600">
                          <p><span class="text-danger">Due Date: </span>{{ assignment.end_date }}</p>
                        </h6>
                        <h6 style="color: gray">
                          <b>{{ assignment.title }}</b>
                        </h6>
                      </div>
                      <i data-feather="tag"></i>
                      <i class="mt-4 icofont icofont-simple-right"></i>
                    </div>
                    </Link>
                    <div class="dashboard-chart-container">
                      <div class="small-chart-gradient-1"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-else>
            <div class="row mt-3">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <p class="text-center"><i>{{ __('No assignment is pending for your class') }}.</i></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="row">
            <div class="col-6">
              <h6 style="font-family: 'Poppins', sans-serif; color: #838383; font-size: 15px !important">
                <b>{{ __('Pending Assessments') }}</b>
              </h6>
            </div>
            <div class="col-6">
              <Link :href="route('student.assessments.index')" class="btn btn-light pull-right p-10"><b>{{ __('Show all') }}</b></Link>
            </div>
          </div>
          <div class="row mt-3" v-if="pendingAssessment.length">
            <div v-for="(assessment, index) in pendingAssessment" :key="index" class="col-md-12">
              <div class="card">
                <div class="card-body" style=" cursor: pointer; padding: 15px 30px 5px 30px !important;">
                  <div class="chart-widget-dashboard">
                    <Link :href="route('student.assessments.instructions', assessment.id)">
                    <div class="media">
                      <div class="media-body">
                        <h6 class="f-w-600">
                          <p><span class="text-danger">Due Date: </span>{{ assessment.end_date }}</p>
                        </h6>
                        <h6 style="color: gray">
                          <b>{{ assessment.title }}</b>
                        </h6>
                      </div>
                      <i data-feather="tag"></i>
                      <i class="mt-4 icofont icofont-simple-right"></i>
                    </div>
                    </Link>
                    <div class="dashboard-chart-container">
                      <div class="small-chart-gradient-1"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-else>
            <div class="row mt-3">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <p class="text-center"><i>{{ __('No assessment is pending for your class') }}.</i></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>
<script>
import { Link, Head } from "@inertiajs/inertia-vue3";
import Sidebar from "@/Pages/Student/Layout/Sidebar.vue";
import PageMainHeader from "@/Pages/Student/Layout/PageMainHeader.vue";
import Layout from "@/Pages/Student/Layout/Layout.vue";
import PageHeader from "@/Pages/Student/Layout/PageHeader.vue";
export default {
  props: {
    avatar: String | Boolean,
    student: Object,
    lessons: Object,
    pendingAssignments: Object,
    pendingAssessment: Object,
  },
  name: "admin-layout",
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
  },
};
</script>