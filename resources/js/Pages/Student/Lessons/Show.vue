<template>
  <Head :title="__('Lesson Details')" />
  <PageMainHeader />
  <div class="page-body-wrapper">
    <Sidebar />
    <div class="page-body">
      <div class="container-fluid">
        <PageHeader />
      </div>
      <div class="container-fluid">
        <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
          <p>{{ $page.props.flash.success }}</p>
        </div>
        <div class="card">
          <div class="card-header">
            <h6>{{ __('Lesson') }}: {{ lesson.title }}</h6>
            <div class="card-header-right">
              <Link :href="route('student.active-lessons.index')" class="pull-right white"><i
                class="fa fa-caret-left white"></i>{{ __('Back') }}</Link>
            </div>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link" :class="{ active: activeTab === 'description' }" href="#"
                    @click="activateTab('description')" role="tab" aria-controls="description"
                    aria-selected="false">{{ __('Description') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" :class="{ active: activeTab === 'video' }" href="#" @click="activateTab('video')"
                    role="tab" aria-controls="video" aria-selected="true">{{ __('Video') }}</a>
                </li>
              </ul>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade p-10"
                :class="{ show: activeTab === 'description', active: activeTab === 'description' }" id="description"
                role="tabpanel" aria-labelledby="description-tab">
                <div v-if="lesson.description" v-html="lesson.description"></div>
                <p v-else class="mt-5 text-center"><i>{{ __('No description is provided for this lesson') }}.</i></p>
              </div>
              <div class="tab-pane fade p-10" :class="{ show: activeTab === 'video', active: activeTab === 'video' }"
                id="video" role="tabpanel" aria-labelledby="video-tab">
                <div id="player"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

import Sidebar from "@/Pages/Student/Layout/Sidebar.vue";
import PageMainHeader from "@/Pages/Student/Layout/PageMainHeader.vue";
import Layout from "@/Pages/Student/Layout/Layout.vue";
import PageHeader from "@/Pages/Student/Layout/PageHeader.vue";
import { Link, Head } from "@inertiajs/inertia-vue3";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import VuePdfEmbed from "vue-pdf-embed";
import { ref, watch, onMounted, onUnmounted } from "vue";
import Pusher from 'pusher-js';
import axios from 'axios';

export default {
  props: {
    video_progress: Number,
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
  setup(props) {

    let activeTab = ref('description');

    function activateTab(tab) {
      activeTab.value = tab; // update the value of activeTab
    }

    const player = ref(null);
    const watchTime = ref(0);
    let progress = ref(0);
    let buffer = ref(0);
    let intervalId = null;

    const getVideoId = (url) => {
      var regex = /(?:\?v=|&v=|youtu\.be\/)(.*?)(?:\?|&|$)/;
      var match = url.match(regex);
      if (match && match[1]) {
        return match[1];
      } else {
        return null;
      }
    };

    onMounted(() => {
      const onPlayerStateChangeClosure = (event) => onPlayerStateChange(event, props);

      // Load the YouTube IFrame Player API
      const tag = document.createElement('script');
      tag.src = 'https://www.youtube.com/iframe_api';
      const firstScriptTag = document.getElementsByTagName('script')[1];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // Initialize the embedded player
      window.onYouTubeIframeAPIReady = () => {
        player.value = new window.YT.Player('player', {
          videoId: getVideoId(props.lesson.youtube_link),
          events: {
            'onStateChange': onPlayerStateChangeClosure,
          },
        });
      };
    });

    const saveProgress = (value) => {
      axios
        .post(`/student/lessons/${props.lesson.id}/save-progress`, { progress: value })
        .then((response) => {
          // console.log(response)
        });
    };

    onUnmounted(() => {
      clearInterval(intervalId);
    });

    function onPlayerSeek(event) {
      // console.log(event);
    };

    function onPlayerStateChange(event, props) {
      // If students progress is already at or above 80%, there is no need to save it again.
      // We deem a progress of 80% satisfactory for video participation.
      if (props.video_progress < 80) {
        if (event.data === window.YT.PlayerState.PLAYING) {
          // Start tracking watch time when the video starts playing
          let duration = player.value.getDuration();

          intervalId = setInterval(() => {
            buffer.value = player.value.getVideoLoadedFraction();
            watchTime.value = player.value.getCurrentTime();
            progress.value = (watchTime.value / duration) * 100;
            buffer.value = (buffer.value / 1) * 100;
            // Send watch time to your server or save it to a database
            saveProgress(progress.value);
          }, 3000);
        } else if (event.data === window.YT.PlayerState.PAUSED) {
          // Stop tracking watch time when the video is paused
          clearInterval(intervalId);
        } else if (event.data === window.YT.PlayerState.ENDED) {
          clearInterval(intervalId);
          progress.value = 100;
          saveProgress(progress.value);
        }
      }
    }

    return { player, watchTime, progress, buffer, activeTab, activateTab };
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

.lesson-nav-link {
  padding: 10px 25px 10px 20px;
  font-size: 25px;
}

.nav-tabs .lesson-nav-link {
  margin-bottom: -1px;
  border-left: 0px solid;
  border-right: 1px solid transparent;
  border-top: 5px solid #428db7 !important;
}

.lesson-tab-content {
  background-color: white;
}

#player {
  width: 100%;
  /* display: block;
  margin: 0 auto; */
}
</style>