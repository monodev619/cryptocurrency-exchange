const Welcome = () => import('~/pages/welcome').then(m => m.default || m)
const Login = () => import('~/pages/auth/login').then(m => m.default || m)
const Register = () => import('~/pages/auth/register').then(m => m.default || m)
const PasswordEmail = () => import('~/pages/auth/password/email').then(m => m.default || m)
const PasswordReset = () => import('~/pages/auth/password/reset').then(m => m.default || m)
const NotFound = () => import('~/pages/errors/404').then(m => m.default || m)

const Home = () => import('~/pages/home').then(m => m.default || m)
const Setting = () => import('~/pages/settings/setting').then(m => m.default || m)
const Profile = () => import('~/pages/settings/profile').then(m => m.default || m)
const Password = () => import('~/pages/settings/password').then(m => m.default || m)
const Balance = () => import('~/pages/wallets/balance').then(m => m.default || m)
const Market = () => import('~/pages/markets/market').then(m => m.default || m)
const Order = () => import('~/pages/orders/orders').then(m => m.default || m)
const mainMarket = () => import('~/pages/main/main').then(m => m.default || m)




export default [
  { path: '/', name: 'welcome', component: Welcome },

  { path: '/login', name: 'login', component: Login },
  { path: '/register', name: 'register', component: Register },
  { path: '/password/reset', name: 'password.request', component: PasswordEmail },
  { path: '/password/reset/:token', name: 'password.reset', component: PasswordReset },

  { path: '/home', name: 'home', component: Home },
  { path: '/settings', name: 'settings',  component: Setting,
    children: [
        // { path: '/', redirect: { name: 'settings.profile' }},
        { path: 'profile', name: 'settings.profile', component: Profile },
        { path: 'password', name: 'settings.password', component: Password }
    ]
  },
  { path: '/wallets', name: 'wallets', component: Balance },
  { path: '/markets', name: 'markets', component: Market },
  { path: '/orders', name: 'orders', component: Order },
  { path: '/main', name: 'mainwindow', component: mainMarket },
  { path: '*', component: NotFound }
]
