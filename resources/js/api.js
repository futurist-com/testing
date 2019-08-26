class Api {
    constructor () {}
    call (requestType, url, data = null) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, data)
                .then(response => {
                    resolve(response);
                })
                .catch(({response}) => {
                    if (response.status === 401) {
                        console.log(url);
                        auth.logout();
                    }
    
                    reject(response);
                });
        });
    }
}

export default Api;