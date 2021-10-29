<template>
  <div class="mt-5 md:mt-0 md:col-span-2">
    <form @submit.prevent="submit">
      <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-2">
              <div v-if="!errors.brand" class="border-0 px-4 py-3">
                <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
              </div>
              <div v-else class="border-0 bg-red-100 px-4 py-3 text-red-700">
                 <label for="model" class="block text-sm font-medium text-gray-700">{{ errors.brand }}</label>
              </div>
              <input type="text" v-model="form.brand" id="brand" autocomplete="off" class="mt-1 p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <div class="col-span-6 sm:col-span-2">
              <div v-if="!errors.model" class="border-0 px-4 py-3">
                <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
              </div>
              <div v-else class="border-0 bg-red-100 px-4 py-3 text-red-700">
                 <label for="model" class="block text-sm font-medium text-gray-700">{{ errors.model }}</label>
              </div>
              <input type="text" v-model="form.model" id="model" autocomplete="off" class="mt-1 p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

          </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
          <button type="submit" :disabled="form.processing" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Save
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia'

export default {
  remember: 'form',
  data() {
    return {
      form: {
        brand: '',
        model: '',
      },
      errors: Object,
    }
  },
  methods: {
    submit(){
      let data = new FormData()
      data.append('brand', this.form.brand)
      data.append('model', this.form.model)

      Inertia.post(route('page1.store'), data, {
        preserveScroll: true,
        onBefore: () => {
          //confirm('Are you sure ?')
          if(!this.form.brand.trim().length){
            this.errors = Object.assign({}, {brand: "The brand field is required..."})
            Inertia.cancel()
          }
          if(!this.form.model.trim().length){
            this.errors = Object.assign({}, {model: "The model field is required..."})
            Inertia.cancel()
          }
        },
        onSuccess: () => {
          this.form.brand = ''
          this.form.model = ''
          this.errors = {}
        },
        onError: () => {
          this.errors = Object.assign({}, this.$parent.$parent.$parent.page.props.errors)
        },
      })

      //axios.post(route('page1.store'), this.form)
    },
  },

}
</script>
