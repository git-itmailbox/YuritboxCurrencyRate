import authRoutes from './auth'
import Home from '../components/Base/Home'
import Main from "../components/Base/Main";
import CurrencyList from "../components/Currencies/CurrencyList";

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
            {
                path: '/rate',
                name: 'currencies',
                component: CurrencyList,
                meta: { nameTransKey: 'route.currencyList', leaf: true, uiIcon: 'el-icon-school' },
            },
        ]
    },
    ...authRoutes
]
