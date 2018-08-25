<template>
  <div class="container">
    <div class="level">
      <div class="level-item article-look">
        <div class="content">
          <h6 class="title is-6">最多浏览</h6>
          <p class="article-look-item" v-for="(item, key) in view" :key="item.id" :item="item" @click="toTop">
            <i><img src="../assets/tag.png" /></i> <router-link :to="{path: '/ArticleDetail',query: { id: item.id }}">{{item.title}}</router-link>
          </p>
        </div>
      </div>
      <div class="level-item article-new">
        <div class="content">
          <h6 class="title is-6">最新文章</h6>
          <p class="article-new-item" v-for="(item, key) in recent" :key="item.id" :item="item" @click="toTop">
            <i><img src="../assets/tag.png" /></i> <router-link :to="{path: '/ArticleDetail',query: { id: item.id }}">{{item.title}}</router-link>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Sidelist',
  props: ["view", "recent"],
  methods: {
    toTop() {
      window.scrollTo(0, 0);
    }
  },
  data () {
    return {
    }
  },
  mounted: function () {
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.container {
  width: 300px;
  min-width: 300px;
}
.article-new {
  padding-top: 1em;
  border-top: 1px solid #dbdbdb;
}
.level {
  flex-direction: column !important;
}
.level-item {
  width: 100% !important;
  margin-bottom: 2em;
  margin-right: 0 !important;
}
.content {
  width: 100% !important;
}
h6 {
  margin-bottom: 1em !important;
}
p {
  width: 100% !important;
  margin-bottom: 0.2em !important;
  text-align: left !important;
  letter-spacing: 1px;
}
i img {
  vertical-align: text-top;
}
@media screen and (max-width: 760px) {
  .container {
    width: 100%;
    padding-top: 1em;
    border-top: 1px solid #dbdbdb;
  }
}
</style>
