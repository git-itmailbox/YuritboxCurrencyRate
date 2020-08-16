import CurrencyList from "../components/Currencies/CurrencyList";
import CurrencyView from "../components/Currencies/CurrencyView";
import Page from "../components/Page";

export const ROUTE_CURRENCIES_LIST = 'route.currencies.list'
export const ROUTE_CURRENCIES_VIEW = 'route.currencies.view'

export const routes = [
    {
        path: 'currencies',
        component: Page,
        name: 'currency',
        meta: {
            uiIcon: 'el-icon-ship',
            pageTitle: 'pageTitle.currency'
        },
        children: [
        {
            path: '',
            name: ROUTE_CURRENCIES_LIST,
            component: CurrencyList,
            meta: { pageTitle: 'pageTitle.currencyList'}
        },
        {
            path: ':id',
            name: ROUTE_CURRENCIES_VIEW,
            component: CurrencyView,
            meta: { pageTitle: 'pageTitle.currenciesView', hidden:true }
        }
        ]
    }

]
