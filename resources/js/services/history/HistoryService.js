import axios from 'axios'
import { query } from 'js-query-builder';

export class HistoryService {

    constructor() {
        this.API_ENDPOINT = `${process.env.MIX_API_ENDPOINT}history`
        this.defaultPagination = {page:1, size:5}
    }

    fetchAll(options) {
        const p = {...this.defaultPagination, ...options.pagination}
        const q = query(this.API_ENDPOINT)
            .param('size', p.size)
            .filter('currency_id', options.currency)
            .page(p.page)
        if(options.filter && !!options.filter.date_from && !!options.filter.date_to){
                q.filter('date_between', [options.filter.date_from,options.filter.date_to])
        }
        const url = q.build()
        return axios.get(url)
    }
}
