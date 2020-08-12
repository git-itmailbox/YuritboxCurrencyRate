import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import * as fromCommonRoutes from '../routes'
import * as fromAuthSetup from './auth-setup'
import * as fromStore from './../store'
import locale from 'element-ui/lib/locale/lang/en'

export function setupPlugins(Vue) {
    Vue.use(ElementUI, {locale})
    Vue.use(VueRouter)
    Vue.use(Vuex)
}

export function makeOptions(Vue) {
    const router = new VueRouter({
        routes: fromCommonRoutes.routes,
        mode: 'history'
    })

    Vue.router = router

    fromAuthSetup.plugin(Vue)

    const store = new Vuex.Store(fromStore.storeOptions)

    return {
        store,
        router,
    }
}
