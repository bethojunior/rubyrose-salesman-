class ConnectionServer {

    static Host() {
        return HOST.hosts.web;
    }

    static HostApi() {
        return HOST.hosts.api;
    }

    /**
     *
     * @param endPoint
     * @param method
     * @param formData
     * @param resolve
     * @param api
     * @param isFormData
     * @returns {Promise<Response>}
     */
    static sendRequest(endPoint,method = 'GET',formData,resolve,api = false,isFormData = false)
    {
        if(isFormData){
            formData.append('_token', document.querySelector(`meta[name='csrf-token']`)
                .getAttribute('content'));
        }

        var myHeaders = new Headers({
            "X-Requested-With": "XMLHttpRequest",
        });

        var myInit = {
            method: method,
            headers: myHeaders,
            mode: 'cors',
            cache: 'default',
            body: formData,
        };


        if(api){
            return fetch(ConnectionServer.HostApi()+endPoint,myInit)
                .then(function(response) {
                    resolve(response.json())
                })
                .catch(function(error) {
                    resolve(error)
                });
        }
        return fetch(ConnectionServer.Host()+endPoint,myInit)
            .then(function(response) {
                resolve(response.json())
            })
            .catch(function(error) {
                resolve(error)
            });

    }

    /**
     *
     * @param url
     * @param method
     * @param params
     * @param resolve
     */
    static sendRequestApi(url, method = "GET", params = null, resolve = undefined) {

        const request = new XMLHttpRequest();

        request.onreadystatechange = function () {
            if (request.readyState === 4) {
                resolve(JSON.parse(this.responseText))
            }
        };
        request.open(method, ConnectionServer.HostApi() + url);
        request.send(ConnectionServer.prepareRequest(params, false));
    }

    /**
     *
     * @param params
     * @param isStdObject
     * @returns {string}
     */
    static prepareRequest(params, isStdObject) {
        if (!isStdObject)
            return JSON.stringify(params);

        if (!Array.isArray(params)) {
            params = [params];
        }
        return JSON.stringify({stdObject: params});
    }

    /**
     *
     * @param url
     * @param method
     * @param params
     * @param resolve
     */
    static simpleRequest(url, method = "POST" , params ,resolve){
        $.ajax({
            url: ConnectionServer.HostApi() + url,
            method: method,
            data: params,
            success: function(res){
                resolve(res)
            }
        })
    }

}
