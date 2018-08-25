import Vue from 'vue'
import Router from 'vue-router'
import AllWrapper from '@/components/AllWrapper'
import TechnologyWrapper from '@/components/TechnologyWrapper'
import LifeWrapper from '@/components/LifeWrapper'
import TalkWrapper from '@/components/TalkWrapper'
import ArticleDetail from '@/components/ArticleDetail'
import ColumnWrapper from '@/components/ColumnWrapper'

Vue.use(Router)
// var data = {items: [
//   { author: 'John Smith', name: '@johnsmith', text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.', date: '2018-8-9', tag: '技术' },
//   { author: 'John Smith', name: '@johnsmith', text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.', date: '2018-8-9', tag: '技术' },
//   { author: 'John Smith', name: '@johnsmith', text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur sit amet massa fringilla egestas. Nullam condimentum luctus turpis.', date: '2018-8-9', tag: '技术' }
// ]}
export default new Router({
  routes: [
    {
      path: '/',
      name: 'All',
      component: AllWrapper
    },
    {
      path: '/Technology/',
      name: 'Technology',
      component: TechnologyWrapper
    },
    {
      path: '/Life/',
      name: 'Life',
      component: LifeWrapper
    },
    {
      path: '/Talk/',
      name: 'Talk',
      component: TalkWrapper
    },
    {
      path: '/ArticleDetail/',
      name: 'ArticleDetail',
      component: ArticleDetail
    },
    {
      path: '/ColumnWrapper/',
      name: 'ColumnWrapper',
      component: ColumnWrapper
    }
  ]
})
