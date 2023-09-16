<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
  status: String,
});

const form = useForm({
  email: '',
});

const submit = () => {
  form.post(route('password.email'));
};
</script>

<template>
  <Head title="Forgot Password" />
  <div class="page-wrapper">
    <div class="container-fluid p-0">
      <!-- login page start-->
      <div class="authentication-main">
        <div class="row">
          <div class="col-md-12">
            <div class="auth-innerright">
              <div class="authentication-box">
                <div class="text-center">
                  <AuthenticationCardLogo :logo="'/public/images/logo.png'" />
                </div>
                <div class="card mt-4">
                  <div class="card-body">
                    <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                    <p v-if="status" class="font-success f-w-600">
                        {{ status }}
                    </p>
                    <form @submit.prevent="submit">
                      <div class="mb-3">
                        <input
                          class="form-control"
                          v-model="form.email"
                          placeholder="Enter Your Email"
                          id="email"
                          type="email"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                      </div>

                      <div class="text-center">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                          Email Password Reset Link
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
