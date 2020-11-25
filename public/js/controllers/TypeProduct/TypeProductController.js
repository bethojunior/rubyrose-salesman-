class TypeProductController extends ConnectionServer{
    static delete(id)
    {
        return new Promise(resolve => {
            this.sendRequest(`typeProduct/${id}`,'DELETE',null,resolve,true)
        })
    }
}
