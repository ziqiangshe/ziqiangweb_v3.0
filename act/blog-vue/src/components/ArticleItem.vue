<template>
  <div class="box">
    <article class="media">
      <div class="media-left">
        <figure class="image is-64x64">
          <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
        </figure>
      </div>
      <div class="media-content">
        <div class="content">
          <div class="level is-mobile info">
            <div class="level-left">
              <strong>{{item.realname}}</strong>&nbsp; <small>{{item.session}}届{{item.position}}</small>
            </div>
            <div class="level-right">
              <div class="tip" @click="toTop"><router-link :to="{path: '/ArticleDetail',query: { id: item.id }}">MORE</router-link></div>
            </div>
          </div>
          <p>{{item.title}}</p>
        </div>
        <nav class="level is-mobile">
          <div class="level-left">
            <span class="tag">{{item.tag}}</span>
          </div>
          <div class="level-right">
            <small>{{item.create_time}}</small>
          </div>
        </nav>
      </div>
    </article>
  </div>
</template>

<script>
export default {
  name: 'ArticleItem',
  props: ['item'],
  methods: {
    toTop() {
      window.scrollTo(0, 0);
    }
  },
  data () {
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.tip {
  color: #0087FF;
  cursor: pointer;
}
.info {
  margin-bottom: 0.5rem !important;
}
@media screen and (max-width: 760px) {
  .box {
    padding: 0.8rem;
  }
}
</style>
