import router from '@/router.js'
import axios from 'axios'


export default {

    apiCallUnauthourized () {
        return axios
        .create({
            baseURL: 'http://localhost:8765',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
            },
            timeout: 10000,
        })
    },

    apiCall() {
        let CustomHeader = {}

        if (localStorage.getItem('jwt')) {
            CustomHeader = {
                Accept: 'application/json',
                'Content-Type': 'application/json',
                Authorization: 'Bearer ' + localStorage.getItem('jwt'),
            }
        } else {
            CustomHeader = {
                Accept: 'application/json',
                'Content-Type': 'application/json',
            }
        }
        
        let call = axios.create({
            baseURL: 'http://localhost:8765',
            headers: CustomHeader,
            timeout: 60 * 4 * 1000,
        })

        call.interceptors.response.use(
            response => {
                if (response.status === 200 || response.status === 201) {
                    return Promise.resolve(response)
                } else {
                    return Promise.reject(response)
                }
            },
            error => {
                if (error.response.status) {
                    switch (error.response.status) {
                        case 401:
                            router.push({ name: 'Login' })
                            break
                        case 403:
                            router.push({ name: 'Login' })
                            break
                    }
                    return Promise.reject(error.response)
                }
            },
        )

        return call
    },
}