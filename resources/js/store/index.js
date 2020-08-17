import Vue from 'vue'
import Vuex from 'vuex'
import company from './modules/company'
import test from './modules/test'

Vue.use(Vuex)

export default new Vuex.Store({
    modules:{
        company,
        test
    }
})