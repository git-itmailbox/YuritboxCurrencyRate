import VueRouter from 'vue-router'
import Vuex from 'vuex'
import * as fromCommonRoutes from '../routes'
import * as fromI18nSetup from './i18n-setup'
import * as fromAuthSetup from './auth-setup'
import * as fromStore from './../store'

export function setupPlugins(Vue) {
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
        i18n: fromI18nSetup.makeI18nInstance()
    }
}
