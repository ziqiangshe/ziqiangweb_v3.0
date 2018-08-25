<template>
  <nav class="pagination is-centered" role="navigation" aria-label="pagination">
    <a class="pagination-previous" @click="prev">Previous</a>
    <a class="pagination-next" @click="next">Next page</a>
    <ul class="pagination-list">
      <li v-for="(item, key) in num" :key="item.id" :item="item" @click="thisPage"><a class="pagination-link" :aria-label="setArialabel(key)">{{item}}</a></li>
      <!-- <li><a class="pagination-link" aria-label="Goto page 1">1</a></li>
      <li><span class="pagination-ellipsis">&hellip;</span></li>
      <li><a class="pagination-link" aria-label="Goto page 45">45</a></li>
      <li><a class="pagination-link is-current" aria-label="Page 46" aria-current="page">46</a></li>
      <li><a class="pagination-link" aria-label="Goto page 47">47</a></li>
      <li><span class="pagination-ellipsis">&hellip;</span></li>
      <li><a class="pagination-link" aria-label="Goto page 86">86</a></li> -->
    </ul>
  </nav>
</template>

<script>
export default {
  name: 'Pagination',
  props: ["num", "current"],
  methods: {
    setArialabel(key) {
      let str = "Goto page " + key;
      return str;
    },
    prev() {
      if(this._props.current <= 1) {
        return;
      }
      else {
        let pageIndex = this._props.current - 1;
        this.$emit('prevPage', pageIndex);
        document.getElementsByClassName('is-current')[0].classList.remove('is-current');
        document.getElementsByClassName('pagination-link')[pageIndex-1].classList.add('is-current');
      }
    },
    next() {
      if(this._props.current >= this._props.num.length) {
        return;
      }
      else {
        let pageIndex = this._props.current + 1;
        this.$emit('nextPage', pageIndex);
        document.getElementsByClassName('is-current')[0].classList.remove('is-current');
        document.getElementsByClassName('pagination-link')[pageIndex-1].classList.add('is-current');
      }
    },
    thisPage(e) {
      let pageIndex = e.target.text;
      this.$emit('toPage', pageIndex);
      document.getElementsByClassName('is-current')[0].classList.remove('is-current');
      document.getElementsByClassName('pagination-link')[pageIndex-1].classList.add('is-current');
    },
    getElementByAttr(tag,attr,value) {
      var aElements = document.getElementsByTagName(tag);
      var aEle = [];
      for(var i = 0; i < aElements.length; i++)
      {
        if(aElements[i].getAttribute(attr) == value)
            aEle.push(aElements[i]);
      }
      return aEle;
    }
  },
  data () {
    return {
    }
  },
  mounted: function () {
  },
  updated: function () {
    document.getElementsByClassName('pagination-link')[this._props.current-1].classList.add('is-current');
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
