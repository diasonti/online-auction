<template>
  <div id="root">
    <Header />
    <router-view/>
    <Footer />
  </div>
</template>

<style>
#root {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.hidden {
  display: none;
}
</style>
<script>
  import Header from "./components/Header"
  import Footer from "./components/Footer"
  export default {
    components: {Footer, Header}
  }
</script>