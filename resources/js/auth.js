import Axios from "axios";

class Auth {
    constructor() {
        this.token = window.localStorage.getItem('token');
        let userData = window.localStorage.getItem('user');
        this.user = userData ? JSON.parse(userData) : null;
        if (this.token) {
            Axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token;
        }
        this.getUser();
    }
    login(token, user) {
        window.localStorage.setItem('token', token);
        window.localStorage.setItem('user', JSON.stringify(user));
        Axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        this.token = token;
        this.user = user;
        Event.$emit("userLoggedIn");
        //console.log(token);
    }
    check() {
        return !!this.token;
    }
    logout() {
        this.token = null;
        this.user = null;
        window.localStorage.setItem('token', this.token);
        window.localStorage.setItem('user', this.user);
    }
    getUser() {
        api.call('get', '/api/get-user')
        .then(({data}) => {
            this.user = data;
        });
    }
}
export default Auth;