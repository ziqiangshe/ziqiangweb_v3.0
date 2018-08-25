<template>
  <div class="container">
    <column-item></column-item>
    <column-item></column-item>
    <column-item></column-item>
    <column-item></column-item>
  </div>
</template>

<script>
import ColumnItem from './ColumnItem.vue'
export default {
  name: 'ColumnWrapper',
  components: { ColumnItem },
  data () {
    return {
    }
  },
  beforeRouteEnter: (to, from, next) => {
    next(vm => {
      document.getElementsByClassName('Column')[0].classList.add('is-active');
    })
  },
  beforeRouteLeave: (to, from, next) => {
    document.getElementsByClassName('Column')[0].classList.remove('is-active');
    next();
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.container {
  margin-right: 1em;
  padding-right: 2em;
  border-right: 1px solid #dbdbdb;
  display: flex;
  flex-wrap: wrap;
  align-content: flex-start;
  align-items: flex-start;
}
@media screen and (max-width: 760px) {
.container {
  margin-right: 0;
  padding-right: 0;
  border-right: none;
}
}
</style>
