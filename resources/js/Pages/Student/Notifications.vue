<template>
  <Layout :pageTitle="__('Notice Board')">
    <PageHeader :breadcrumb_title="__('Notice Board')" />
    <div class="container-fluid mt-4">
      <div class="card">
        <div class="card-header">
          <h4 class="header-title">{{ __('Announcements') }}</h4>
        </div>
        <div class="card-body recent-notification">
          <div v-if="read_notifications.length || new_notifications.length">
            <div class="media" v-for="notification in new_notifications" :key="notification.id">
              <h6 class="date">{{ notification.data.created_at }}</h6>
              <div class="media-body">
                <span>
                  <Link :href="`/student/read-notification?notificationId=${notificationId(notification)}`"
                    class="message-link"
                    :class="{'text-danger': !notification.data.read_at}"> {{
                      notification.data.message }}</Link>
                </span>
                <p class="f-12">{{ notification.data.title }}</p>
              </div>
            </div>
            <div class="media" v-for="readNotification in read_notifications" :key="readNotification.id">
              <h6 class="date">{{ readNotification.created_at_dates }}</h6>
              <div class="media-body"><span>
                  <Link :href="`/student/read-notification?notificationId=${notificationId(readNotification)}`"
                  class="message-link"
                  :class="{'text-danger': !readNotification.read_at}"> {{
                      readNotification.data.message }}</Link>
                </span>
                <p class="f-12">{{ readNotification.data.title }}</p>
              </div>
            </div>
          </div>
          <p v-else class="text-center">There are currently no new notifications.</p>
        </div>
      </div>
    </div>
  </Layout>
</template>
<script>

import Echo from 'laravel-echo';
import { computed } from 'vue';
import Sidebar from "@/Pages/Student/Layout/Sidebar.vue";
import Layout from "@/Pages/Student/Layout/Layout.vue";
import PageHeader from "@/Pages/Student/Layout/PageHeader.vue";
import PageMainHeader from "@/Pages/Student/Layout/PageMainHeader.vue";
import { Link, Head, usePage, useForm } from "@inertiajs/inertia-vue3";

export default {
  props: {
    read_notifications: Object,
    unread_notifications: Object,
  },
  data() {
    return {
    };
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

    const user = computed(() => usePage().props.value.auth.user);

    const notificationId = computed(() => {
      return (notification) => notification.id ? notification.id : notification.data.id;
    });

    const read_notifications = props.read_notifications;
    let new_notifications = props.unread_notifications;

    const echo = new Echo({
      broadcaster: 'pusher',
      key: import.meta.env.VITE_PUSHER_APP_KEY,
      cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
      forceTLS: true,
      encryption: true
    });

    const privateChannel = 'private-class.' + user.value.student.class_id;

    echo.private(privateChannel).notification((notification) => {
      const data = { data: notification };
      if (data.data.student_id === user.value.student.id) {
        new_notifications.unshift(data);
      }
    });

    return { new_notifications, read_notifications, notificationId }
  },
};
</script>
<style>
.date,
.message-link {
  font-family: 'Inter', sans-serif;
}

.message-link {
  font-weight: 600;
}

.new_notification_color {
  color: #C43256;
}

.read_notification_color {
  color: black;
}

.message-link:hover {
  text-decoration: underline !important;
  color: #C43256 !important;
}
</style>