elementProperty.addEventInElement('#search-id','oninput',function (){
    let key = this.value;
    elementProperty.getElement('.through-sales', cards => {
        let id = cards.getAttribute('id');
        if(id !== key)
            return cards.style.display = 'none'
        return cards.style.display = ''
    })
})

elementProperty.addEventInElement('#clear-filter','onclick',function (){
    elementProperty.getElement('#search-id', these => {
        these.value = '';
    })
    elementProperty.getElement('.through-sales', cards => {
        return cards.style.display = ''
    })
})
