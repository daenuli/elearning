<template>
  <Layout :pageTitle="'Profile'">
    <div class="container-fluid">
      <div class="row mt-5">
        <div class="col-md-12">
          <h1>Realtime notifications</h1>
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
import { watchEffect } from 'vue';
import Echo from 'laravel-echo';

export default {
  props: {
    student: Object
  },
  data() {
    return {
    };
  },
  name: "student-layout",
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
  },
  setup(props) {
    const echo = new Echo({
      broadcaster: 'pusher',
      key: import.meta.env.VITE_PUSHER_APP_KEY,
      cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
      forceTLS: true,
      encryption: true
    });

    watchEffect(() => {
      echo.private('private-class.' + props.student.class_id)
        .notification((notification) => {
          alert('A new assignment has created.')
        });
    });
  },
};
</script>