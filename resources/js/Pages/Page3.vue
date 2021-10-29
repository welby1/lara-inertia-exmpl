<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{title}}</div>

        <div class="card-body">
          <div v-if="loading">
            <Circle10 />
          </div>
          <div v-else>
            <product-list :products="products" />
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-8">
    </div>
  </div>
</template>

<script>
import {Circle10} from 'vue-loading-spinner'
import ProductList from '../Shared/Product/ProductList'
import NProgress from 'nprogress'

NProgress.configure({ parent: '.card-body' });

export default {
  components: {
    Circle10,
    ProductList,
  },
  mounted() {
    //setTimeout(this.getData, 2000)
    this.getData()
  },
  props:{
    title: null,
  },
  methods: {
    getData(){
      NProgress.start()

      axios.get('https://picsum.photos/v2/list?limit=500')
        .then((response) => {
          let a = 'https://coinmap.org/api/v1/venues/'
          this.products = response.data
        })
        .finally(() => {
          this.loading = false
          NProgress.done()
        })
    },
  },
  data(){
    return{
      products: null,
      loading: true,
    }
  }
}
</script>
