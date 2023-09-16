<template>
  <Layout :pageTitle="__('Lesson Details')">
    <PageHeader :breadcrumb_title="__('Lesson Details')" />
    <div class="container-fluid">
      <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
        <p>{{ $page.props.flash.success }}</p>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300">
                <i class="fa fa-book"></i> {{ __('Lesson Details') }}
              </h5>
              <div class="card-header-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <Link :href="route('teacher.lessons.edit', lesson.id)" class="btn btn-xs btn-primary"><i
                    class="fa fa-pencil text-white"></i>{{ __('Edit') }}</Link>
                  <Link :href="route('teacher.lessons.index')" class="btn btn-xs btn-success"><i
                    class="fa fa-arrow-left text-white"></i> {{ __('Back to list') }}</Link>
                </div>
              </div>
            </div>
            <div class="card-body avatar-showcase">
              <div class="table-responsive">
                <table class="table table-sm table-bordered">
                  <tr>
                    <th>{{ __('Title') }}</th>
                    <td>{{ lesson.title }}</td>
                    <th>{{ __('Youtube Link') }}</th>
                    <td>
                      <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target=".view-video">
                        <i class="fa fa-youtube-play"></i>
                      </button>
                      <div class="modal fade view-video" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myLargeModalLabel">
                                {{ __('Youtube Video') }}
                              </h4>
                            </div>
                            <div class="modal-body">
                              <iframe width="100%" height="315" :src="lesson.youtube_video_link" frameborder="0"
                                allowfullscreen></iframe>
                            </div>
                            <div class="modal-footer">
                              <button class="btn btn-light" data-bs-dismiss="modal">
                                {{ __('Close') }}
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th>{{ __('Schedule From') }}</th>
                    <td>{{ lesson.start_date }}</td>
                    <th>{{ __('Schedule To') }}</th>
                    <td>{{ lesson.end_date }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Class') }}</th>
                    <td>{{ lesson.class.name }}</td>
                    <th>{{ __('Study Group') }}</th>
                    <td>{{ lesson.study_group.name }}</td>
                  </tr>
                  <tr>
                    <th>{{ __('Subject') }}</th>
                    <td>{{ lesson.subject.title }}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300"><i class="fa fa-file-pdf-o"></i> {{ __('Files') }}</h5>
            </div>
            <div class="card-body">
              <p v-if="files.length === 0" style="color:gray">{{ __('No files found') }}!</p>
              <table class="table" v-else>
                <tr v-for="(file, i) in files" :key="file">
                  <th>
                    <a href="" data-bs-toggle="modal" :data-bs-target="`.view-file-${i}`">{{ file.name }}</a>
                  </th>
                  <td>
                    <div class="modal fade" :class="`view-file-${i}`" tabindex="-1" role="dialog"
                      aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">
                              {{ file.name }}
                            </h4>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <embed v-if="file.mime_type === 'application/pdf'" :src="file.url" width="100%"
                              height="600px" />
                            <iframe v-else :src="`https://docs.google.com/gview?url=${file.url}&embedded=true`"
                              width="100%" height="500px"></iframe>
                          </div>
                          <div class="modal-footer">
                            <button data-bs-dismiss="modal" class="btn btn-light">
                              {{ __('Close') }}
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="f-w-300"><i class="fa fa-list"></i> {{ __('Description') }}</h5>
            </div>
            <div class="card-body">
              <p v-if="lesson.description === null" style="color:gray">{{ __('No description') }}.</p>
              <div v-else v-html="lesson.description"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
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
    lesson: Object,
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
.vue-pdf-embed>div {
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