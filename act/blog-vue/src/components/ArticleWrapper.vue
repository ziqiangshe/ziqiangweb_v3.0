<template>
  <div class="container">
    <!-- <article-item v-for="(item, key) in items" :key="item.id" :items="items"></article-item> -->
    <article-item  v-for="(item, key) in data" :key="item.id" :item="item"></article-item>
    <pagination></pagination>
  </div>
</template>

<script>
import ArticleItem from './ArticleItem.vue'
import Pagination from './Pagination.vue'
export default {
  name: 'ArticleWrapper',
  components: { ArticleItem, Pagination },
  data () {
    return {
      ite: [
        {name: 'xiaoming'},
        {name: 'lihua'},
        {name: 'haha'}
      ],
      data: {}
    }
  },
  mounted: function () {
    var self = this;
    console.log(this.$route);
    self.$parent.$refs.all.classList.add('is-active');
    // axios({
    //   method: 'get',
    //   url: 'https://www.ziqiangweb.com/ziqiangweb_v3.0/public/index.php?s=/api/blog/get_tag_blog&tag=&offset=&imit='
    // }).then(function(resp) {
    //   self.data = resp.data.data;
    //   console.log(self.data);
    // }).catch(resp => {
    //   console.log('failed!');
    // });
  },
  beforeRouteUpdate: (to,from,next) => {
    console.log('beforeRouteUpdate');
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.container {
  margin-right: 1em;
  padding-right: 2em;
  border-right: 1px solid #dbdbdb;
}
@media screen and (max-width: 760px) {
  .container {
    margin-right: 0;
    margin-bottom: 3em;
    padding-right: 0;
    border-right: none;
  }
}
</style>
