import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    authen: false,
    uid: "",
    key: "",
    role:""
  },
  plugins: [createPersistedState()],
  mutations: {
    setAuthen(state, authen) {
      state.authen = authen
    },
    setKey(state, key) {
      state.key = key
    },
    setUID(state, uid) {
      state.uid = uid
    },
    setRole(state, role) {
      state.role = role
    }
  },
  actions: {

  },
  getters: {
    authen: state => state.authen,
    key: state => state.key,
    uid: state => state.uid,
    role:state => state.role
  }
})
