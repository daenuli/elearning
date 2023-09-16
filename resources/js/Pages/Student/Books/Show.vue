<template>
  <Layout :pageTitle="__('Book Details')">
    <div class="container-fluid">
			<div class="row">
				<div class="col-md-6 pt-3">
					<h3 class="pull-left">{{ book.title }}</h3>
				</div>
				<div class="col-md-6">
					<Link :href="route('student.books.index')" class="btn btn-success pull-right mt-3"><i
						class="fa fa-arrow-left text-white"></i> {{ __('Back to list') }}</Link>
            <a v-bind:disabled="!book.file_path" :href="route('student.books.download', book.id)"
                    :class="{ 'disabled': !book.file_path }" class="btn btn-info mt-3 pull-right mr-1">
                    <i class="fa fa-download"></i> {{ __('Download') }}
                  </a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<embed :src="book.file_path" class="mt-2" width="100%" height="800px" />
				</div>
			</div>
		</div>
  </Layout>
</template>
<script>
import Sidebar from "@/Pages/Student/Layout/Sidebar.vue";
import Layout from "@/Pages/Student/Layout/Layout.vue";
import PageMainHeader from "@/Pages/Student/Layout/PageMainHeader.vue";
import PageHeader from "@/Pages/Student/Layout/PageHeader.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import VuePdfEmbed from "vue-pdf-embed";

export default {
  props: {
    book: Object,
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
  setup() {
    // 
  },
};
</script>