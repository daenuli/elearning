<template>
  <Head title="Assessment Details" />
  <div class="page-wrapper">
    <div class="page-main-header">
      <PageMainHeader />
    </div>
    <div class="page-body-wrapper">
      <Sidebar />
      <div class="page-body">
        <div class="container-fluid">
          <PageHeader />
        </div>
        <div class="container-fluid">
          <div
            v-if="$page.props.flash.success"
            class="alert alert-success"
            role="alert"
          >
            <p>{{ $page.props.flash.success }}</p>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="f-w-300">
                    <i class="fa fa-book"></i> Assessment Details
                  </h5>
                  <div class="card-header-right">
                    <div
                      class="btn-group"
                      role="group"
                      aria-label="Basic example"
                    >
                      <Link
                        :href="route('teacher.assessments.edit', assessment.id)"
                        class="btn btn-xs btn-primary"
                        ><i class="fa fa-pencil text-white"></i>Edit</Link
                      >
                      <Link
                        :href="route('teacher.assessments.index')"
                        class="btn btn-xs btn-success"
                        ><i class="fa fa-arrow-left text-white"></i> Back to
                        list</Link
                      >
                    </div>
                  </div>
                </div>
                <div class="card-body avatar-showcase">
                  <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                      <tr>
                        <th>Title</th>
                        <td>{{ assessment.title }}</td>
                      </tr>
                      <tr>
                        <th>Schedule From</th>
                        <td>{{ assessment.start_date }}</td>
                        <th>Schedule To</th>
                        <td>{{ assessment.end_date }}</td>
                      </tr>
                      <tr>
                        <th>Class</th>
                        <td>{{ assessment.class.name }}</td>
                        <th>Study Group</th>
                        <td>{{ assessment.study_group.name }}</td>
                      </tr>
                    </table>
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
import Sidebar from "@/Pages/Teacher/Layout/Sidebar.vue";
import Layout from "@/Pages/Teacher/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Teacher/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Teacher/Layout/PageHeader.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import VuePdfEmbed from "vue-pdf-embed";

export default {
  props: {
    files: Array,
    assessment: Object,
  },
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    Datepicker,
    VuePdfEmbed,
    PageMainHeader,
  },
};
</script>
<style>
.vue-pdf-embed > div {
  margin-bottom: 8px;
  box-shadow: 0 2px 8px 4px rgba(0, 0, 0, 0.1);
}

.app-header {
  padding: 16px;
  box-shadow: 0 2px 8px 4px rgba(0, 0, 0, 0.1);
  background-color: #555;
  color: #ddd;
}

.app-content {
  padding: 24px 16px;
}

.right {
  float: right;
}
</style>