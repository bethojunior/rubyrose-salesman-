class SalesController extends ConnectionServer{
    /**
     *
     * @param data
     * @returns {Promise<unknown>}
     */
    static create(data)
    {
        return new Promise(resolve => {
            this.simpleRequest('sales','POST', {data},resolve)
        })
    }
}
