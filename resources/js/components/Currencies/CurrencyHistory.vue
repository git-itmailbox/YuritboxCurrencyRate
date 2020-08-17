<template>
    <div>
        <el-row type="flex" class="row-bg" justify="center">
            <el-col :span="6">
                <div class="block">
                    <span>Date From</span>
                    <el-date-picker
                        v-model="historyFilter.date_from"
                        @change="handleDateChanged"
                        type="date"
                        format="yyyy/MM/dd"
                        value-format="yyyy-MM-dd"
                        placeholder="Pick a day">
                    </el-date-picker>
                </div>
            </el-col>
            <el-col :span="6">
                <div class="block">
                    <span>Date To</span>
                    <el-date-picker
                        v-model="historyFilter.date_to"
                        @change="handleDateChanged"
                        type="date"
                        format="yyyy/MM/dd"
                        value-format="yyyy-MM-dd"
                        placeholder="Pick a day">
                    </el-date-picker>
                </div>
            </el-col>
        </el-row><el-row type="flex" class="row-bg" justify="center">
            <el-col :span="24">
                <el-table
                    v-loading="historyLoading"
                    :data="history"
                    style="width: 100%">
                    <el-table-column
                        prop="date"
                        label="Date">
                    </el-table-column>
                    <el-table-column
                        prop="value"
                        label="Value">
                    </el-table-column> <el-table-column
                        prop="nominal"
                        label="Nomainal"
                        width="150">
                    </el-table-column>
                </el-table>

                <el-pagination v-if="historyPagination"
                               @size-change="handleSizeChange"
                               @current-change="handleCurrentChange"
                               :current-page="historyPagination.current"
                               :page-sizes="[5, 10, 20, 50]"
                               :page-size="parseInt(historyPagination.size)"
                               layout="total, sizes, prev, pager, next"
                               :total="historyPagination.total">
                </el-pagination>
            </el-col>
        </el-row>
        <div class="small">
            <line-chart :chart-data="ratesCollection" :height="200"></line-chart>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters, mapMutations} from 'vuex'
    import {HISTORY_FETCH_ALL, HISTORY_SET_ALL, HISTORY_SET_FILTER} from '../../store/history/types'
    import LineChart from '../common/LineChart.js'

    export default {
        components:{LineChart},
        data() {
            return {
                historyFilter: {
                    date_from: null,
                    date_to: null
                }
            }
        },
        props: {
            currency: Object
        },
        created() {
            this[HISTORY_SET_ALL] = []
            this[HISTORY_FETCH_ALL]({currency: this.currency.id})
        },
        mounted() {

        },
        computed: {
            ...mapGetters(['history','historyLoading', 'historyPagination', 'filter']),
            datesIsSet() {
                return !!this.historyFilter.date_from && !!this.historyFilter.date_to;
            },
            ratesCollection() {
                const ratesData = this.history.map(history => history.value)
                const dateLabels = this.history.map(history => history.date)
                return {
                    labels : dateLabels,
                    datasets : [
                       {
                           label : this.currency.charcode,
                            data : [...ratesData],
                            backgroundColor : '#F26202'
                       }
                    ],

            }
            }
        },
        methods: {
            ...mapActions([HISTORY_FETCH_ALL]),
            ...mapMutations([HISTORY_SET_ALL, HISTORY_SET_FILTER]),
            handleSizeChange(val) {
                const paginationOptions = {...this.historyPagination, ...{size:val}}

                this[HISTORY_FETCH_ALL]({
                    pagination:paginationOptions,
                    filter: this.filter,
                    currency: this.currency.id
                })
            },
            handleCurrentChange(val) {
                const paginationOptions = {...this.historyPagination, ...{page:val}}
                this[HISTORY_FETCH_ALL]({
                    pagination: paginationOptions,
                    filter: this.filter,
                    currency: this.currency.id
                })
            },
            handleDateChanged(val) {
                if(this.datesIsSet){
                    this[HISTORY_SET_FILTER](this.historyFilter)
                }
            },
        },
        watch: {
            filter: {
                handler() {
                    this[HISTORY_FETCH_ALL]({
                        filter: this.filter,
                        currency: this.currency.id
                    })
                },
                deep: true
            }
        }
    }
</script>

<style>
    .small {
        max-width: 600px;
        margin:  15px auto;
    }
</style>
