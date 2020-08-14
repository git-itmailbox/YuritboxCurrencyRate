import * as fromCurrenciesTypes from './types'
import {CurrencyService} from '../../services/currencies/CurrencyService'
const currencyService = new CurrencyService()

export const store = {
    state: {
        currencies: [],
        currency: null,
        currencyLoading: false,
        currencyPagination: {
            page:1,
            size:5
        },
    },
    mutations: {
        [fromCurrenciesTypes.CURRENCY_SET_ALL](state, data) {
            state.currencies = data
        },
        [fromCurrenciesTypes.CURRENCY_SET_ONE](state, currency) {
            state.currency = currency
        },
        [fromCurrenciesTypes.CURRENCY_SET_LOADING](state, isLoading) {
            state.currencyLoading = isLoading
        },
        [fromCurrenciesTypes.CURRENCY_SET_PAGINATION](state, pagination) {
            state.currencyPagination = pagination
        },
    },
    getters: {
        currency: (state) => state.currency,
        currencyList: (state) => state.currencies,
        currencyLoading: (state) => state.currencyLoading,
        currencyPagination: (state) => state.currencyPagination,
    },
    actions: {
        async [fromCurrenciesTypes.CURRENCY_FETCH_ALL]({ commit }, pagination={}) {
            commit(fromCurrenciesTypes.CURRENCY_SET_LOADING, true)
            const response = await currencyService.fetchAll(pagination)
            commit(fromCurrenciesTypes.CURRENCY_SET_ALL, response.data.data)
            commit(fromCurrenciesTypes.CURRENCY_SET_PAGINATION, response.data.pagination)
            commit(fromCurrenciesTypes.CURRENCY_SET_LOADING, false)
        },
        async [fromCurrenciesTypes.CURRENCY_FETCH_ONE]({ commit }, id) {
            const response = await currencyService.fetchOne(id)
            commit(fromCurrenciesTypes.CURRENCY_SET_ONE, response.data.data)
        }
    }
}
