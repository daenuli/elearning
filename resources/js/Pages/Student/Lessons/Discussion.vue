<template>
  <Head title="Lesson Details" />
  <PageMainHeader />
  <div class="page-body-wrapper">
    <Sidebar />
    <div class="page-body">
      <div class="container-fluid">
        <PageHeader />
      </div>
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h4 class="lesson-title">{{ lesson.title }}</h4>
            <span>{{ lesson.subject.title }}</span>
            <div class="card-header-right">
              <Link :href="route('student.active-lessons.index')" class="white"><i
                class="fa fa-caret-left white"></i>Back</Link>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="row chat-box">
              <div class="col-md-12 pr-0">
                <form class="form theme-form" @submit.prevent="submit">
                  <div ref="chatHistory" class="chat-history chat-msg-box custom-scrollbar">
                    <ul v-if="messages.length">
                      <li class="message mt-4" v-for="message in messages" :key="message.text">
                        <div class="avatar">
                          <img :src="message.avatar" alt="Avatar" />
                        </div>
                        <div class="message-content">
                          <div class="sender-info">
                            <span class="sender-name">{{ message.user_name }}</span>
                            <span class="message-time">{{ message.created_at }}</span>
                          </div>
                          <div class="message-text">
                            {{ message.text }}
                          </div>
                        </div>
                      </li>
                    </ul>
                    <h6 v-else class="text-center default-message">Start a conversation with your fellow classmates about
                      the lesson! Ask questions, share insights, and collaborate with each other to deepen your
                      understanding of the material.</h6>
                  </div>
                  <div class="clearfix" id="chat-input">
                    <div class="row">
                      <div class="col-xl-12">
                        <div class="input-group ">
                          <input class="form-control input-txt-bx" id="message-to-send" type="text" v-model="message"
                            name="message-to-send" placeholder="Write your message...">
                          <div class="input-group-append">
                            <button class="btn btn-light" type="submit"><i class="fa fa-send"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
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
import { watchEffect } from 'vue';
import Echo from 'laravel-echo';
import { ref, onMounted, reactive } from 'vue';

export default {
  props: {
    lesson: Object,
    student: Object,
    models: Object,
    avatar: String
  },
  components: {
    Link,
    Head,
    Layout,
    Sidebar,
    PageHeader,
    PageMainHeader,
  },
  setup(props) {

    let message = ref('');
    let messages = ref([]);

    onMounted(() => {
      messages.value = props.models.data;
    });

    const echo = new Echo({
      broadcaster: 'pusher',
      key: import.meta.env.VITE_PUSHER_APP_KEY,
      cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
      forceTLS: true,
      encryption: true
    });

    watchEffect(() => {
      echo.channel('lesson-created-notification')
        .listen('LessonCreated', (data) => {
          if (data.message.studentId !== props.student.id) {
            let incommingMessage = {
              type: 'you',
              avatar: data.avatar,
              created_at: getTime(),
              user_name: data.user_name,
              text: data.message.message,
            };
            messages.value.push(incommingMessage);
          }
        });
    });

    function getTime() {
      const now = new Date();
      const hours = now.getHours() % 12 || 12; // convert to 12-hour format
      const minutes = now.getMinutes().toString().padStart(2, '0'); // add leading zero if needed
      const amOrPm = now.getHours() < 12 ? 'AM' : 'PM';
      const time = `${hours}:${minutes} ${amOrPm}`;
      return time;
    }

    function submit() {
      let newMessage = {
        user_name: props.student.user.name,
        avatar: props.avatar,
        type: 'me', text: message.value,
        studentId: props.student.id,
        created_at: getTime()
      };
      messages.value.push(newMessage);
      message.value = '';



      axios.post(route('student.lessons.discussion.store', props.lesson.id), {
        message: newMessage.text
      }).then(response => {
        const chatHistory = document.querySelector('.chat-history');
        chatHistory.scrollTop = chatHistory.scrollHeight;

      }).catch(error => {
      });
    };

    return { submit, message, messages };
  },
};
</script>
<style>
.chat-box .chat-right-aside .chat .chat-msg-box .other-message {
  background-color: #f1f5fb !important;
}

.chat-box .chat-right-aside .chat .chat-msg-box .my-message {
  background-color: #f1ffef !important;
}

.chat-messages {
  list-style: none;
  margin: 0;
  padding: 0;
}

.message {
  display: flex;
  align-items: flex-start;
  margin-bottom: 10px !important;
}

.avatar {
  width: auto;
  height: auto;
  max-width: 40px;
  max-height: 40px;
  border-radius: 10%;
  overflow: hidden;
  margin-right: 10px;
}

.avatar img {
  width: 100%;
  height: auto;
}

.sender-info {
  display: flex;
  align-items: center;
  font-weight: bold;
  font-size: 14px;
  line-height: 1.5;
  margin-bottom: 5px;
}

.sender-name {
  margin-right: 5px;
}

.message-time {
  color: #999;
  font-weight: normal;
}

.message-text {
  font-size: 14px;
  line-height: 1.5;
  color: #333;
}

.message:hover {
  background-color: #f5f5f5;
}

.chat-messages>li {
  margin-bottom: 0;
  padding-bottom: 10px;
}

.chat-msg-box {
  height: 600px;
  overflow-y: scroll;
}

.chat-history {
  overflow-y: scroll;
  scroll-behavior: smooth;
}

.message:last-child::before {
  content: "";
  display: block;
  height: 1px;
  margin-top: 10px;
}

.default-message {
  display: flex;
  justify-content: center;
  align-items: center;
  color: #666;
  height: 100%;
}

.chat-box {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100%;
}

.card .card-header {
    background-color: #ffffff !important;
    color: #242424 !important;
    border-bottom: 1px solid #e1e2e5 !important;
    border-radius: 0px !important;
    padding: 15px 0px 10px 20px !important;
  }
  .lesson-title {
    font-size: 18px !important;
    color: #012c0c !important;
  }

  .input-txt-bx{
    height: calc(4.25rem + 2px) !important;
    border: 1px solid #e1e1e1 !important;
  }
</style>