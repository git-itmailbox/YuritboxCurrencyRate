import axios from 'axios'
import { query } from 'js-query-builder';

export class CurrencyService {

    constructor() {
        this.API_ENDPOINT = `${process.env.MIX_API_ENDPOINT}rates`
        this.defaultPagination = {page:1, size:5}
    }

    fetchAll(pagination) {
        const p = {...this.defaultPagination, ...pagination}
        console.log(pagination,p)
        const url = query(this.API_ENDPOINT)
            // .size(pagination.size)
            .param('size', p.size)
            .page(p.page)
            .build()
        return axios.get(url)
    }

    fetchOne(id) {
        return axios.get(`${this.API_ENDPOINT}/${id}`)
    }
}
