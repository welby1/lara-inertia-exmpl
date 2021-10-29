<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ title }}</div>

        <div class="card-body">
          <p class="h4">Hello, {{ loggedAs.name }}. Your email: {{ loggedAs.email }}</p>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <FormTestRememberState />
    </div>
  </div>
</template>

<script>
import FormTestRememberState from '../Shared/FormTestRememberState'

export default {
  components: {
    FormTestRememberState
  },
  mounted() {
      console.log('Component mounted.')
  },
  props: {
    title: '',
  },
  computed: {
    loggedAs(){
      return this.$parent.$parent.page.props.auth.user
    }
  }
}
</script>
