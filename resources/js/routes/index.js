import authRoutes from './auth'
import * as currenciesRoutes from './currencies'
import Home from '../components/Base/Home'
import Main from "../components/Base/Main";
import CurrencyList from "../components/Currencies/CurrencyList";
import CurrencyView from "../components/Currencies/CurrencyView";

export const ROUTE_MAIN_PAGE = 'route.main_page';

export const routes = [
    {
        path: '',
        component: Home,
        meta: { auth: true, nameTransKey: 'route.main' },
        children: [
            {
                path: '/',
                name: 'mainpage',
                component: Main,
                meta: { nameTransKey: 'route.main', leaf: true, uiIcon: 'el-icon-school' },
            },
            // {
            //     path: '/currencies',
            //     name: 'currencies',
            //     component: CurrencyList,
            //     meta: { nameTransKey: 'route.currencyList', leaf: true, uiIcon: 'el-icon-school' },
            // },
            //  {
            //     path: '/currencies/:id',
            //     name: 'View Currency',
            //     component: CurrencyView,
            //     meta: { nameTransKey: 'route.currencyView', leaf: true, uiIcon: 'el-icon-school' },
            // },
            ...currenciesRoutes.routes

        ]
    },
    ...authRoutes,

]
