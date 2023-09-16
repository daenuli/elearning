<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
  email: String,
  token: String,
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('password.update'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <Head title="Reset Password" />
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
                    <form @submit.prevent="submit">
                      <div class="mb-3">
                        <input class="form-control" v-model="form.email" placeholder="Enter Your Email" id="email"
                          type="email" />
                        <InputError class="mt-2" :message="form.errors.email" />
                      </div>
                      <div class="mb-3">
                        <input class="form-control" v-model="form.password" placeholder="Password" id="password"
                          type="password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                      </div>

                      <div class="mb-3">
                        <input class="form-control" v-model="form.password_confirmation" placeholder="Confirm Password"
                          id="password" type="password" />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                      </div>

                      <div class="text-center">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                          Reset Password
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
