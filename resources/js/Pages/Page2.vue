<template>
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">{{title}}</div>

              <div class="card-body">
                  <div v-for="(item, index) in 100">
                    <p :key="index">{{item}}</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    },
    props:{
      title: '',
    }
}
</script>
