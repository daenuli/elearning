<template>
  <div>
    <Head :title="pageTitle" />
    <PageMainHeader />
    <div class="page-body-wrapper">
      <Sidebar />
      <div class="page-body">
        <div class="container-fluid">
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
import { Head } from "@inertiajs/inertia-vue3";
import Sidebar from "@/Pages/Admin/Layout/Sidebar.vue";
import PageMainHeader from "@/Pages/Admin/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Admin/Layout/PageHeader.vue";
export default {
  props: {
    pageTitle: {
      type: String,
      required: true
    },
  },
  components: {
    Head,
    Sidebar,
    PageHeader,
    PageMainHeader,
  },
};
</script>