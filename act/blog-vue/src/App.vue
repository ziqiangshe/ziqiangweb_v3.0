<template>
  <div id="app">
    <navbar></navbar>
    <mainer></mainer>
    <bottom-nav></bottom-nav>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue'
import Mainer from './components/Mainer.vue'
import BottomNav from './components/BottomNav.vue'
export default {
  name: 'App',
  components: { Navbar, Mainer, BottomNav }
}
</script>

<style>
html, body, div {
  margin: 0;
  padding: 0;
}
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
