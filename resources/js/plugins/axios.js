import axios from 'axios'
import store from '../store'
import router from '../router'
import Swal from 'sweetalert2'
import i18n from '../plugins/i18n'

// Request interceptor
axios.interceptors.request.use(request => {
    const token = store.getters['auth/token']
    if (token) {
        request.headers.common['Authorization'] = `Bearer ${token}`
    }

    const locale = store.getters['lang/locale']
    if (locale) {
        request.headers.common['Accept-Language'] = locale
    }

    // request.headers['X-Socket-Id'] = Echo.socketId()

    return request
})

// Response interceptor
axios.interceptors.response.use(response => response, error => {
    const {status} = error.response;

    if (status >= 500) {
        Swal.fire({
            icon: 'error',
            title: i18n.t('Oops'),
            text: i18n.t('Something went wrong! Please try again later'),
            reverseButtons: true,
            confirmButtonText: i18n.t('Ok'),
        })
    }

    if (status === 401 && store.getters['auth/token']) {
        Swal.fire({
            icon: 'warning',
            title: i18n.t('Session Expired'),
            text: i18n.t('Please log in again to continue'),
            reverseButtons: true,
            confirmButtonText: i18n.t('Ok'),
        }).then(() => {
            console.log('logout');
            store.commit('auth/LOGOUT')
            router.push({name: 'welcome'})
        })
    }

    if (status === 422) {
        Swal.fire({
            icon: 'warning',
            title: i18n.t('Validation error'),
            text: error.response.data.error,
            reverseButtons: true,
            confirmButtonText: i18n.t('Ok'),
        })
    }

    if (status === 423) {
        Swal.fire({
            icon: 'warning',
            title: i18n.t('SendPulse'),
            text: i18n.t('Please connect a user'),
            reverseButtons: true,
            confirmButtonText: i18n.t('Connect'),
        }).then(() => {
            router.push({name: 'settings'})
        })
    }
    if (status === 404) {
        Swal.fire({
            icon: 'info',
            title: i18n.t('404'),
            text: i18n.t('Resource is not found'),
            reverseButtons: true,
            confirmButtonText: i18n.t('Ok'),
        }).then(() => {
            router.push({name: 'automation'})
        })
    }

    return Promise.reject(error)
})
