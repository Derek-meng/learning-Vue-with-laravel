import jwtToken from './../../helpers/jwt'
import * as types from "../mutation-type";

export default {
    actions: {
        loginRequest({dispatch}, formData) {
            return axios.post('/api/login', formData).then(response => {
                jwtToken.setToken(response.data.token);
                dispatch('setAuthUser')
            }).catch(error => {
                console.log(error.response);
            })
        },
        logoutRequest({dispatch}) {
            return axios.get('/api/logout').then(response => {
                jwtToken.removeToken();
                dispatch('unsetAuthUser')
            })
        }
    }
}
