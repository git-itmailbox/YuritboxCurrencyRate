import * as fromAppModule from './app/store'
import * as fromCurrenciesModule from './currencies/store'

export const storeOptions = {
    modules: {
        app: fromAppModule.store,
        currencies: fromCurrenciesModule.store
    },
    strict: process.env.NODE_ENV !== 'production'
}
