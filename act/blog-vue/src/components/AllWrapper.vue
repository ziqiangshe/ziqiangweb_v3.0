<template>
  <div class="container">
    <article-item  v-for="(item, key) in all" :key="item.id" :item="item"></article-item>
    <pagination :num="num" :current="current" @prevPage="toPrev" @nextPage="toNext" @toPage="tothispage"></pagination>
  </div>
</template>

<script>
import ArticleItem from './ArticleItem.vue'
import Pagination from './Pagination.vue'
export default {
  name: 'AllWrapper',
  components: { ArticleItem, Pagination },
  props: ["all"],
  methods: {
    toPrev(pageIndex) {
      this.current = pageIndex;
      console.log(this);
    },
    toNext(pageIndex) {
      this.current = pageIndex;
      console.log(this);
    },
    tothispage(pageIndex) {
      this.current = pageIndex;
    }
  },
  data () {
    return {
      group: {},
      num: [],
      current: 1,
    }
  },
  mounted: function () {
    let amount = Math.ceil(this._props.all.length / 10);
    let index = 0;
    for(let i = 1; i <= amount; i++) {
      this.group[i] = [];
      this.num.push(i);
      do{
        this.group[i].push(this._props.all[index]);
        index++;
      }while(index % 10 != 0 && index < this._props.all.length);
    }
  },
  beforeRouteEnter: (to, from, next) => {
    next(vm => {
      document.getElementsByClassName('All')[0].classList.add('is-active');
    })
  },
  beforeRouteLeave: (to, from, next) => {
    document.getElementsByClassName('All')[0].classList.remove('is-active');
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
