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

    /**
     *
     * @returns {Promise<unknown>}
     */
    static getPhone()
    {
        return new Promise(resolve => {
            this.phone('phone','GET', '',resolve)
        })
    }
}
