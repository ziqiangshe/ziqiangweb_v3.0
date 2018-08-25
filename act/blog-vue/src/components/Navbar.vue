<template>
  <div class="navbar">
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <p class="image is-64x64">
            <img src="../assets/logo.png" alt="">
          </p>
        </div>
        <div class="level-item">
          <p class="logo-text">自强博客</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Navbar',
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.navbar {
  padding: 10px;
  background: #fff;
  box-shadow: 0 2px 8px #f0f1f2;
}
.logo-text{
  font-family: 'Microsoft YaHei', sans-serif;
  font-size: 32px;
  font-weight: bold;
}
</style>
