<template>
    <el-card class="box-card" v-loading="currencyLoading">
        <template v-if="currency">
            <el-row>
                <el-col :span="12">CharCode</el-col>
                <el-col :span="12">{{currency.charcode}}</el-col>
            </el-row>
            <el-row>
                <el-col :span="12">NumCode</el-col>
                <el-col :span="12">{{currency.numcode}}</el-col>
            </el-row>
            <el-row>
                <el-col :span="12">Name</el-col>
                <el-col :span="12">{{currency.name}}</el-col>
            </el-row>
            <el-divider content-position="center">Currency History</el-divider>
            <CurrencyHistory :currency="$route.params.id"></CurrencyHistory>
        </template>
    </el-card>
</template>

<script>
    import {mapActions, mapGetters, mapMutations} from 'vuex'
    import {
        CURRENCY_FETCH_ONE,
        CURRENCY_SET_ONE
    } from '../../store/currencies/types'
    import CurrencyHistory from "./CurrencyHistory";

    export default {
        components:{CurrencyHistory},
        created() {
            this[CURRENCY_SET_ONE] = null
            this[CURRENCY_FETCH_ONE](this.$route.params.id)
        },
        mounted() {

        },
        computed: {
            ...mapGetters(['currency','currencyLoading', ]),
        },
        methods: {
            ...mapActions([CURRENCY_FETCH_ONE]),
            ...mapMutations([CURRENCY_SET_ONE]),
        }
    }
</script>
