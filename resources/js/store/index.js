import * as fromAppModule from './app/store'

export const storeOptions = {
    modules: {
        app: fromAppModule.store,
    },
    strict: process.env.NODE_ENV !== 'production'
}
