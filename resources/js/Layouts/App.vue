<template>
  <div>
    <Header />

    <head>
      <title>{{ getTitle }}</title>
      <meta name="description" :content="getTitle">
    </head>

    <main class="container">

      <article class="py-32 px-5 mb-36 z-30">
        <slot />
      </article>

    </main>

    <Footer />
  </div>
</template>

<script>
import Header from './Header'
import Footer from './Footer'
import { Head } from '@inertiajs/inertia-vue'

export default {
  components: {
    Header,
    Footer,
    Head,
  },
  computed:{
    getTitle(){
      return this.$parent.page.props.title
    }
  },
}
</script>
<style>
  html {
    overflow-y: scroll;
    overflow-y: overlay;
  }
  body::-webkit-scrollbar {
    width: 3px;
  }
  body::-webkit-scrollbar-thumb {
    background-color: gray;
    border-radius: 50px;
  }
</style>
