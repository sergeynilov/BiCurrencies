<template>
  <Head title="Log in" />

  <jet-authentication-card>
    <template #logo>
      <jet-application-logo  :icon_type="'big'" :layout="'frontend'"  />
    </template>

    <div class="card-body">

      <div v-if="status" class="alert alert-success mb-3 rounded-0" role="alert">
        {{ status }}
      </div>

      <form @submit.prevent="submit">
        <div class="form-group">
          <jet-label for="email" value="Email" />
          <jet-input id="email" type="email" v-model="form.email" required autofocus />
        </div>

        <div class="form-group">
          <jet-label for="password" value="Password" />
          <jet-input id="password" type="password" v-model="form.password" required autocomplete="current-password" />
        </div>

        <div class="form-group">
          <div class="custom-control custom-checkbox">
            <jet-checkbox id="remember_me" name="remember" v-model:checked="form.remember" />

            <label class="custom-control-label" for="remember_me">
              Remember Me
            </label>
          </div>
        </div>

        <div class="mb-0">
          <div class="d-flex justify-content-end align-items-baseline">
            <Link  v-if="canResetPassword" :href="route('password.request')" class="text-muted me-3">
              Forgot your password?
            </Link>

            <jet-button type="submit" class="ms-4" :class="{ 'text-white-50': form.processing }"  :disabled="form.processing">
              Log in
            </jet-button>
          </div>
        </div>
      </form>
    </div>
  </jet-authentication-card>
</template>

<script>
import { defineComponent } from 'vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
      JetApplicationLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    Link,
  },

  props: {
    canResetPassword: Boolean,
    status: String
  },

  data() {
    return {
      form: this.$inertia.form({
        // email: 'john_doe@site.com',
        // password: '11111111',
        email: 'ShawnHadray@site.com',
        password: '111111',
        remember: false
      })
    }
  },

    /* define("ACCESS_APP_ADMIN", 1);  // Admin
    ShawnHadray@site.com  111111

    define("ACCESS_APP_SUPPORT_MANAGER", 2);
    PatLongred@site.com 111111

    define("ACCESS_APP_CONTENT_EDITOR", 3);
john_doe@site.com  11111111
 */
  methods: {
    submit() {
      this.form
          .transform(data => ({
            ... data,
            remember: this.form.remember ? 'on' : ''
          }))
          .post(this.route('login'), {
            onFinish: () => this.form.reset('password'),
          })
    }
  }
})
</script>
