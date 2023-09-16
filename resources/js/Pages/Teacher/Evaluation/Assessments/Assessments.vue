<template>
  <Layout :pageTitle="__('Student Assessments')">
    <PageHeader :breadcrumb_title="__('Student Assessments')" />
    <div class="container-fluid mt-3">
      <div class="row">
        <div class="col-md-4">
          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label"><b>{{ __('FilterBy Class') }}</b></label>
            <div class="col-sm-7">
              <select v-model="class_id" @change="search" class="form-control form-control-sm"
                id="exampleFormControlSelect31">
                <option value=""> ({{ __('All Classes') }})</option>
                <option :value="school_class.id" v-for="school_class in classes" :key="school_class.id">
                  {{ school_class.name }}
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label"><b>{{ __('FilterBy Study Group') }}</b></label>
            <div class="col-sm-7">
              <select v-model="study_group_id" @change="search" class="form-control form-control-sm"
                id="exampleFormControlSelect31">
                <option value=""> ({{ __('All Study Groups') }})</option>
                <option :value="study_group.id" v-for="study_group in study_groups" :key="study_group.id">
                  {{ study_group.name }}
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="mb-3 row">
            <label class="col-sm-5 col-form-label"><b>{{ __('FilterBy Subject') }}</b></label>
            <div class="col-sm-7">
              <select v-model="subject_id" @change="search" class="form-control form-control-sm" id="filterBySubject">
                <option value=""> ({{ __('All Subjects') }})</option>
                <option :value="subject.id" v-for="subject in subjects" :key="subject.id">
                  {{ subject.title }}
                </option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3" v-if="submittedAssessments.length">
        <div class="col-sm-4" v-for="assessment in submittedAssessments" :key="assessment.id">
          <div class="card">
            <Link :href="
              route('teacher.evaluation.student.assessments', assessment.id)
            ">
            <div class="card-body">
              <div class="media">
                <p class="mb-0" style="color: gray">{{ __('Due Date') }}: </p> <span class="text-danger">&nbsp;{{
                  assessment.due_date_label }}</span>
              </div>
              <div class="project-widgets text-center">
                <h6 class="font-primary counter"><b>{{ assessment.title }}</b></h6>
                <p>{{ assessment.subject.title }}</p>
              </div>
            </div>
            <div class="card-footer project-footer" style="display: flex; justify-content: space-between;">
              <h6 class="mb-0"><b>{{ __('Class') }}:</b> <span class="counter"><b>{{ assessment.class.name }}</b></span></h6>
              <h6 class="mb-0"><b>{{ __('Study Group') }}:</b> <span class="counter"><b>{{ assessment.study_group.name }}</b></span>
              </h6>
            </div>
            </Link>
          </div>
        </div>
      </div>
      <div v-else class="row mt-5">
        <div class="col-md-12">
          <p class="text-center"><i>{{ __('No assessments found') }}.</i></p>
        </div>
      </div>
    </div>
  </Layout>
</template>
<script>

import { ref } from "vue";
import moment from 'moment'
import { Link, Head } from "@inertiajs/inertia-vue3";
import Layout from "@/Pages/Teacher/Layout/Layout.vue";
import Sidebar from "@/Pages/Teacher/Layout/Sidebar.vue";
import PageHeader from "@/Pages/Teacher/Layout/PageHeader.vue";
import PageMainHeader from "@/Pages/Teacher/Layout/PageMainHeader.vue";

export default {
  props: {
    subjects: Object,
    classes: Object,
    assessments: Object,
    study_groups: Object,
  },
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
    moment
  },
  setup(props) {
    let class_id = ref('');
    let subject_id = ref('');
    let study_group_id = ref('');
    let submittedAssessments = ref(props.assessments);

    const search = () => {

      axios.get(route('teacher.evaluation.assessments.search'), {
        params: {
          class_id: class_id.value,
          study_group_id: study_group_id.value,
          subject_id: subject_id.value
        }
      })
        .then(response => {
          submittedAssessments.value = [];
          submittedAssessments.value = response.data;
        });
    };

    return {
      search,
      class_id,
      study_group_id,
      subject_id,
      submittedAssessments
    }
  }
};
</script>