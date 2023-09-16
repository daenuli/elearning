<template>
  <div class="p-10">
    <PageHeader />
    <div v-if="message && !is_submitted" class="alert alert-success" role="alert">
      <p>{{ message }}</p>
    </div>
    <div class="card" v-if="!is_submitted">
      <div class="card-body">
        <div>
          <p>Hi {{ $page.props.user.name }}</p>
          <p>
            Congratulations on completing the exam! We hope it went well for you. We wanted to let you know that your
            assessment has been received and will be graded shortly.

            Thank you for your hard work and dedication during the exam.
          </p>
          <p>
            E learning management system
          </p>
        </div>
      </div>
    </div>
    <div v-else>
      <div v-if="message && is_submitted" class="" role="alert">
        <p class="text-danger text-center">{{ message }}</p>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-md-12 text-center">
        <Link class="btn btn-primary" :href="route('student.dashboard')">Back to home</Link>
      </div>
    </div>
  </div>
</template>
<script>
import Sidebar from "@/Pages/Student/Layout/Sidebar.vue";
import Layout from "@/Pages/Student/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Student/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Student/Layout/PageHeader.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";

export default {
  props: {
    message: String,
    is_submitted: Boolean
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