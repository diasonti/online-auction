<template>
  <div id="app">
    <Header />
    <router-view/>
    <Footer />
  </div>
</template>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>
<script>
  import Header from "./components/Header"
  import Footer from "./components/Footer"
  export default {
    components: {Footer, Header}
  }
</script>