<template>
  <div class="card">
    <div class="content">
      <h5 class="title is-5">论产品如何不被打</h5>
      <div class="info">
        <p class="author">义工服务队</p>
        <p class="articlenum">2篇文章</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ColumnItem',
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.card {
  width: 28em;
  height: 8em;
  margin: 1em auto;
  background: url('../assets/column1.png') 100% no-repeat;
  cursor: pointer;
  align-self: flex-start;
}
.content {
  width: 100%;
  height: 100%;
  padding-top: 2em;
  color: #fff;
  background: rgba(0, 0, 0, 0);
  top: 0;
  left: 0;
  position: absolute;
  z-index: 100;
  transition: all 0.3s;
}
.content:hover {
  background: rgba(0, 0, 0, 0.5);
  transition: all 0.3s;
}
h5 {
  margin-bottom: 1rem !important;
  color: #fff;
}
.info {
  display: flex;
  justify-content: center;
}
.articlenum:before {
  content: '\B7';
  margin: 0 .4rem;
}
</style>
