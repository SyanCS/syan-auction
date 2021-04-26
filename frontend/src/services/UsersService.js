import APIService from '@/services/APIService.js'

export default {
    authentication (email, password) {
        return APIService.apiCallUnauthourized()
        .post('/users/login.json', {
            email: email,
            password: password
        })
    },
    sendRequestEmail(nome, email) {
        const postData = {
            nome: nome,
            email: email
        }
        return APIService.apiCall().post(
            '/users/send_request_email.json',
            JSON.stringify(postData),
        )
    }
}
