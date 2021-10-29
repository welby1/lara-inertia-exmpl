<template>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed w-full z-40">
    <div class="container">
      <Link class="navbar-brand" href="/" :class="{ 'active': this.$parent.$parent.page.url === '/' }">{{ this.$parent.$parent.initialPage.props.appName }}</Link>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">
          <Link
            class="nav-link"
            :href="route('page1')"
            :class="{ 'active': this.$parent.$parent.page.url === '/page1' }"
            preserve-scroll
          >
          Page1
          </Link>
          <Link
            class="nav-link"
            :href="route('page2')"
            :class="{ 'active': this.$parent.$parent.page.url === '/page2' }"
            preserve-scroll
          >
          Page2
          </Link>
          <Link
            class="nav-link"
            :href="route('page3')"
            :class="{ 'active': this.$parent.$parent.page.url === '/page3' }"
            preserve-scroll
          >
          Page3
          </Link>
          <Link
            class="nav-link"
            :href="route('page4')"
            :class="{ 'active': this.$parent.$parent.page.url === '/page4' }"
            preserve-scroll
          >
          Page4
          </Link>
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <li v-if="!loggedAs" class="nav-item">
              <Link 
                class="nav-link" 
                :href="route('form.login')"
                :class="{ 'active': this.$parent.$parent.page.url === '/form/login' }"
              >
              Login
              </Link>
          </li>
          <li v-else class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ loggedAs.email }}
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <Link class="dropdown-item" @click="logout">Logout</Link>
              </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'
import { Inertia } from '@inertiajs/inertia'

export default {
  components: {
    Link,
  },
  methods: {
    logout(){
      axios.post('/logout')
        .then(Inertia.visit('/form/login'))
    }
  },
  computed: {
    loggedAs(){
      return this.$parent.$parent.page.props.auth.user
    }
  }
}
</script>
<style scoped>
  .active {
    color: red !important;
    text-decoration: underline;
  }
</style>
