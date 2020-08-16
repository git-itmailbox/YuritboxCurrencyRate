<template>
    <div class="">
        <el-table
            v-loading="currencyLoading"
            :data="currencyList"
            @row-click="viewCurrencyHistory"
            style="width: 100%">
            <el-table-column
                prop="name"
                label="Name"
                width="300">
            </el-table-column>
            <el-table-column
                prop="numcode"
                label="Numcode"
                width="180">
            </el-table-column>
            <el-table-column
                prop="charcode"
                label="Charcode">
            </el-table-column>
            <el-table-column
                prop="rateValue"
                label="Rate">
            </el-table-column>
            <el-table-column
                label="Date">
                <template slot-scope="scope">
                    <i class="el-icon-date"></i>
                    <span style="margin-left: 10px">{{ scope.row.rate.date }}</span>
                </template>
            </el-table-column>
        </el-table>

        <el-pagination v-if="currencyPagination"
            @size-change="handleSizeChange"
            @current-change="handleCurrentChange"
            :current-page="currencyPagination.current"
            :page-sizes="[5, 10, 20, 50]"
            :page-size="parseInt(currencyPagination.size)"
            layout="sizes, prev, pager, next"
            :total="currencyPagination.total">
        </el-pagination>
    </div>
</template>

<script>
    import {mapActions, mapGetters, mapMutations} from 'vuex'
    import {CURRENCY_FETCH_ALL,CURRENCY_SET_ALL} from '../../store/currencies/types'
    import {ROUTE_CURRENCIES_VIEW} from "../../routes/currencies";

    export default {
        data() {
            return {

            };
        },
        created() {
                this[CURRENCY_SET_ALL] = []
                this[CURRENCY_FETCH_ALL]()
        },
        mounted() {

        },
        computed: {
            ...mapGetters(['currencyList','currencyLoading', 'currencyPagination', ]),
        },
        methods: {
            ...mapActions([CURRENCY_FETCH_ALL]),
            ...mapMutations([CURRENCY_SET_ALL]),
            handleSizeChange(val) {
                const paginationOptions = {...this.currencyPagination, ...{size:val}}
                this[CURRENCY_FETCH_ALL](paginationOptions)
            },
            handleCurrentChange(val) {
                const paginationOptions = {...this.currencyPagination, ...{page:val}}
                this[CURRENCY_FETCH_ALL](paginationOptions)
            },
            viewCurrencyHistory(item){
                this.$router.push({ name: ROUTE_CURRENCIES_VIEW, params: { id: item.id } })
            }
        },
    }
</script>

<style lang="scss">

    el-table.cell{
        word-break: keep-all;
    }
</style>
