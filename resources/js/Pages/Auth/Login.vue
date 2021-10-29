<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ labels.login }}</div>

                    <div class="card-body">
                        <form @submit.prevent="login">
                            <!--@csrf -->

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ labels.email }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" :class="{ 'is-invalid': errors }" name="email" v-model="form.email" required autocomplete="email" autofocus>

                                        <span v-if="errors" class="invalid-feedback" role="alert">
                                            <strong>{{ errors }}</strong>
                                        </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ labels.password }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" :class="{ 'is-invalid': errors }" name="password" v-model="form.password" required autocomplete="current-password">

                                        <span v-if="errors" class="invalid-feedback" role="alert">
                                            <strong>{{ errors }}</strong>
                                        </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" v-model="form.rememberMe" id="remember">

                                        <label class="form-check-label" for="remember">
                                            {{ labels.rememberMe }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ labels.login }}
                                    </button>

                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'
import { Inertia } from '@inertiajs/inertia'

export default {
  components: {
    Link,
  },
  data() {
    return {
      labels: {
          login: 'login',
          email: 'email',
          password: 'password',
          rememberMe: 'remember me',
      },
      form: {
          email: null,
          password: null,
          rememberMe: false,
      },
      errors: false,
    }
  },
  methods: {
      login(){
          axios.post('/login', this.form)
            .then(response => {
              Inertia.visit('/page1');
            })
      },
  }
}
</script>