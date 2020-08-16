import * as fromAppModule from './app/store'
import * as fromCurrenciesModule from './currencies/store'
import * as fromHistoryModule from './history/store'

export const storeOptions = {
    modules: {
        app: fromAppModule.store,
        currencies: fromCurrenciesModule.store,
        history: fromHistoryModule.store
    },
    strict: process.env.NODE_ENV !== 'production'
}
