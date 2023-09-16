<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
  canResetPassword: Boolean,
  status: String,
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form
    .transform((data) => ({
      ...data,
      remember: form.remember ? "on" : "",
    }))
    .post(route("login"), {
      onFinish: () => form.reset("password"),
    });
};
</script>

<template>
  <Head title="Log in" />
  <div class="page-wrapper">
    <div class="container-fluid p-0">
      <!-- login page start-->
      <div class="authentication-main">
        <div class="row">
          <div class="col-md-12">
            <div class="auth-innerright">
              <div class="authentication-box">
                <div class="text-center">
                  <AuthenticationCardLogo />
                </div>
                <div class="card mt-4">
                  <div class="card-body">
                    <form @submit.prevent="submit">
                      <div class="mb-3">
                        <label class="col-form-label pt-0">Your Name</label>
                        <input
                          class="form-control"
                          v-model="form.email"
                          type="email"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                      </div>
                      <div class="mb-3">
                        <label class="col-form-label">Password</label>
                        <input
                          v-model="form.password"
                          class="form-control"
                          type="password"
                        />
                        <InputError
                          class="mt-2"
                          :message="form.errors.password"
                        />
                      </div>
                      <div class="pull-right">
                        <Link
                          v-if="canResetPassword"
                          :href="route('password.request')"
                          class="
                            underline
                            text-sm text-gray-600
                            hover:text-gray-900
                          "
                        >
                          Forgot your password?
                        </Link>

                        <PrimaryButton
                          class="ml-4"
                          :class="{ 'opacity-25': form.processing }"
                          :disabled="form.processing"
                        >
                          Log in
                        </PrimaryButton>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- login page end-->
    </div>
  </div>
</template>
