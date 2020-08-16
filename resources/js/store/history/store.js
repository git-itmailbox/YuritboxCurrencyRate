import * as fromHistoryTypes from './types'
import {HistoryService} from '../../services/history/HistoryService'
const historyService = new HistoryService()

export const store = {
    state: {
        history: [],
        historyLoading: false,
        historyPagination: {
            page: 1,
            size: 5
        },
        filter: {
            date_from: null,
            date_to: null
        }
    },
    mutations: {
        [fromHistoryTypes.HISTORY_SET_ALL](state, data) {
            state.history = data
        },
        [fromHistoryTypes.HISTORY_SET_LOADING](state, isLoading) {
            state.historyLoading = isLoading
        },
        [fromHistoryTypes.HISTORY_SET_PAGINATION](state, pagination) {
            state.historyPagination = pagination
        },
        [fromHistoryTypes.HISTORY_SET_FILTER](state, filter) {
            state.filter = filter
        },
        [fromHistoryTypes.HISTORY_RESET_PAGINATION](state) {
            state.historyLoading = {
                page: 1,
                size: 5
            }
        },
    },
    getters: {
        history: (state) => state.history,
        filter: (state) => state.filter,
        historyLoading: (state) => state.historyLoading,
        historyPagination: (state) => state.historyPagination,
    },
    actions: {
        async [fromHistoryTypes.HISTORY_FETCH_ALL]({ commit }, options={}) {
            console.log(options)
            commit(fromHistoryTypes.HISTORY_SET_LOADING, true)
            const response = await historyService.fetchAll(options)
            commit(fromHistoryTypes.HISTORY_SET_ALL, response.data.data)
            console.log(response.data.pagination)
            commit(fromHistoryTypes.HISTORY_SET_PAGINATION, response.data.pagination)
            commit(fromHistoryTypes.HISTORY_SET_LOADING, false)
        }
    }
}
