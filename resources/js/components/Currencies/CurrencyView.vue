<template>
    <div class="">

    </div>
</template>

<script>
    import {mapActions, mapGetters, mapMutations} from 'vuex'
    import {
        CURRENCY_FETCH_ALL,
        CURRENCY_FETCH_ONE,
        CURRENCY_SET_ALL,
        CURRENCY_SET_ONE
    } from '../../store/currencies/types'

    export default {
        created() {
            this[CURRENCY_SET_ONE] = null
            this[CURRENCY_FETCH_ONE]()
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
