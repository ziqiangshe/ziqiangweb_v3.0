<template>
  <div class="container">
  <div class="box">
    <div class="level is-mobile">
      <div class="level-left">
        <router-link to="/"><i><img src="../assets/back.png" /></i>Back</router-link>
      </div>
    </div>
    <article class="content">
      <h5 class="title is-5">{{data.title}}</h5>
      <div class="content">
        <div class="level is-mobile info">
          <div class="info">
            <strong>{{data.realname}}</strong>&nbsp; <small>{{data.session}}届{{data.position}}</small>
          </div>
        </div>
        <p class="article-content"></p>
      </div>
      <div class="level is-mobile">
        <div class="level-left"><span class="tag">{{data.tag}}</span></div>
        <div class="level-right"><small>{{data.create_time}}</small></div>
      </div>
    </article>
  </div>
  </div>
</template>

<script>
export default {
  name: 'ArticleDetail',
  props: ["all"],
  data () {
    return {
      data: {}
    }
  },
  watch: {
    $route: {
      handler: function(val, oldVal) {
        for(let i of this.all) {
          if(i.id == this.$route.query.id) {
            this.data = i;
            document.getElementsByClassName('article-content')[0].innerHTML = this.data.content;
          }
        }
      }
    }
  },
  mounted: function() {
    for(let i of this.all) {
      if(i.id == this.$route.query.id) {
        this.data = i;
        document.getElementsByClassName('article-content')[0].innerHTML = this.data.content;
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.box {
  margin-right: 1em;
  padding-right: 1.25rem;
}
.info {
  justify-content: center;
}
span {
  color: #0087FF;
}
i img {
  vertical-align: text-top;
}
p {
  text-indent: 2em;
  text-align: justify;
}
@media screen and (max-width: 760px) {
.box {
  margin-right: 0;
  margin-bottom: 2em;
  padding-right: 1.25rem;
  border-bottom: 1px solid #dbdbdb;
}
}
</style>
