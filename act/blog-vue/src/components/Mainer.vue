<template>
  <div class="hero">
    <div class="hero-body">
      <div class="container">
        <div class="tabs">
          <ul>
            <li class="All"><router-link to="/">全部</router-link></li>
            <li class="Technology"><router-link to="/Technology/">技术</router-link></li>
            <li class="Life"><router-link to="/Life/">生活</router-link></li>
            <li class="Talk"><router-link to="/Talk/">杂谈</router-link></li>
            <li class="Column"><router-link to="/ColumnWrapper/">专栏</router-link></li>
          </ul>
        </div>
        <div class="level">
          <router-view v-if="isShow" :all="all" :technology="technology" :life="life" :talk="talk" :column="column"></router-view>
          <sidelist v-bind:view="view" v-bind:recent="recent"></sidelist>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Sidelist from './Sidelist.vue'
import axios from 'axios'
export default {
  name: 'Mainer',
  components: { Sidelist },
  methods: {
  },
  data () {
    return {
      all: [],
      technology: [],
      life: [],
      talk: [],
      column: [],
      view: [],
      recent: [],
      isShow: false
    }
  },
  mounted: function () {
    var self = this;
    axios({
      method: 'get',
      url: 'https://www.ziqiangweb.com/ziqiangweb_v3.0/public/index.php?s=/api/blog/get_tag_blog&tag=&offset=&imit='
    }).then(function(resp) {
      self.recent = [...resp.data.data.slice(0, (resp.data.data.length < 5) ? resp.data.data.length - 1 : 5)];
      for(let i of resp.data.data) {
        self.all.push(i);
        switch(i.tag) {
          case '技术': self.technology.push(i);break;
          case '生活': self.life.push(i);break;
          case '杂谈': self.talk.push(i);break;
          default: break;
        }
      }
      self.isShow = true;
    }).catch(resp => {
      console.log('failed!');
    });
    axios({
      method: 'get',
      url: 'https://www.ziqiangweb.com/ziqiangweb_v3.0/public/index.php?s=/api/blog/get_page_view_blog'
    }).then(function(resp) {
      self.view = [...resp.data.data];
    }).catch(resp => {
      console.log('failed!');
    });
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.tabs ul {
  border-bottom: 1px solid #dbdbdb;
}
.level {
  align-items: flex-start !important;
}
</style>
