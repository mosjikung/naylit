import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import LayoutSignin from '../Layouts/LayoutSignin.vue'
import LayoutDefault from '../Layouts/LayoutDefault.vue'
import Signin from '../views/Signin.vue'
import Page from '../views/paging.vue'
import SOList from '../components/SOlist.vue'
import QTReport from '../views/QTReport.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/home',
    component: LayoutDefault,
    children: [{
       path: '/home',
      name: 'home',
      component: Home,
      meta: {
        title: 'Home Page - NAYLIT',
        metaTags: [
          {
            name: 'description',
            content: 'The home page of our example app.'
          },
          {
            property: 'og:description',
            content: 'The home page of our example app.'
          }
        ]
      }
    }]
  },
    {
    path: '/QTReport/:ou/:batch',
    // path: '/QTReport',
    name: 'QTReport',
    component: () => import(/* webpackChunkName: "QTReport" */ '../views/QTReport.vue')
  },
      {
    path: '/Inspec/:ou/:batch',
    // path: '/QTReport',
    name: 'Inspec',
    component: () => import(/* webpackChunkName: "QTReport" */ '../views/Inspec.vue')
  },
  // {
  //   path: '/couter',
  //   name: 'couter',
  //   component: () => import(/* webpackChunkName: "couter" */ '../views/Couter.vue')
  // },
  {
    path: '/',
    component: LayoutSignin,
    children: [
      {
        path: '/',
        name: 'signin',
        component: Signin,
        meta: {
          title: 'NAYLIT Signin',
          metaTags: [
            {
              name: 'description',
              content: 'The home page of our example app.'
            },
            {
              property: 'og:description',
              content: 'The home page of our example app.'
            }
          ]
        }
      },
      {

        path: '/page',
        name: 'page',
        component: Page,

      }
    ]
  }
]

const router = new VueRouter({
  base: process.env.BASE_URL,
  routes
})

// This callback runs before every route change, including on page load.
router.beforeEach((to, from, next) => {
  // This goes through the matched routes from last to first, finding the closest route with a title.
  // eg. if we have /some/deep/nested/route and /some, /deep, and /nested have titles, nested's will be chosen.
  const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title)

  // Find the nearest route element with meta tags.
  const nearestWithMeta = to.matched.slice().reverse().find(r => r.meta && r.meta.metaTags)

  // const previousNearestWithMeta = from.matched.slice().reverse().find(r => r.meta && r.meta.metaTags)

  // If a route with a title was found, set the document (page) title to that value.
  if (nearestWithTitle) document.title = nearestWithTitle.meta.title

  // Remove any stale meta tags from the document using the key attribute we set below.
  Array.from(document.querySelectorAll('[data-vue-router-controlled]')).map(el => el.parentNode.removeChild(el))

  // Skip rendering meta tags if there are none.
  if (!nearestWithMeta) return next()

  // Turn the meta tag definitions into actual elements in the head.
  nearestWithMeta.meta.metaTags.map(tagDef => {
    const tag = document.createElement('meta')

    Object.keys(tagDef).forEach(key => {
      tag.setAttribute(key, tagDef[key])
    })

    // We use this to track which meta tags we create, so we don't interfere with other ones.
    tag.setAttribute('data-vue-router-controlled', '')

    return tag
  })
  // Add the meta tags to the document head.
    .forEach(tag => document.head.appendChild(tag))

  next()
})

export default router
