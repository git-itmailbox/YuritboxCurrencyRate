import * as fromAppTypes from './types'

export const store = {
    state: {
        isAuth: false,
        currentUser: null

    },
    mutations: {
        [fromAppTypes.APP_SET_AUTH](state, isAuth) {
            state.isAuth = isAuth
        },

    },
    getters: {
        [fromAppTypes.APP_IS_AUTH]: (state) => state.isAuth,
    }
}
