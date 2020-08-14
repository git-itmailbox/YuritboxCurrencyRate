import Login from '../components/Auth/Login'

export const ROUTE_LOGIN = 'route.login'

export default [
    {
        path: '/login',
        component: Login,
        name: ROUTE_LOGIN,
    }
]
