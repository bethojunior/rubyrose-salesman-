$('.carousel').carousel({
    interval: 2000
})

let products = [];

elementProperty.addEventInElement('.add-bag','onclick',function (){
    let product = JSON.parse(this.getAttribute('data'));
    let id = product.id;
    elementProperty.getElement(`#qtd-${id}`,product => {
        SwalCustom.dialogConfirm(`Tem certeza que deseja adicionar ${product.value} unidades de ${product.name} a sua sacola?`,'', status => {
            if(!status)
                return false;

            let data = {
                'amount' : product.value,
                'product_id' :  product.id
            };
            products.push(data);
            console.log(products)
            swal(`${product.name} adicionado a sua sacola com sucesso`,'','success');
        })

    });
})

elementProperty.addEventInElement('.add-item','onclick',function (){
    let data = JSON.parse(this.getAttribute('product'));
    let id = data.id;
    elementProperty.getElement(`#qtd-${id}`, product => {
        let actualValue = product.value;
        product.value = (parseInt(actualValue) + 1);

        // SwalCustom.toast(product.value + ' itens | ' + data.name+' Adcionado a sua sacola','','','');
    });
})

elementProperty.addEventInElement('.remove-item','onclick',function (){
    let data = JSON.parse(this.getAttribute('product'));
    let id = data.id;
    let min = parseInt(data.minimum_order);

    elementProperty.getElement(`#qtd-${id}`,product => {
        let actualValue = parseInt(product.value);
        let qtd = product.value = (parseInt(actualValue) - 1);
        // if(qtd > min)
            // return SwalCustom.toast('1 item | ' + data.name+' removido a sua sacola','','','');
        product.value = min;
        return swal(`O pedido mínimo para ${data.name} são ${min} unidades`,'','info');
    });
})

elementProperty.addEventInElement('#product-types','onchange',function (){
    let type = this.value;
    elementProperty.getElement('.product', these => {

        if(type === 'all'){
            return these.style.display = ''
        }

        if(these.getAttribute('type') !== type)
            return these.style.display = 'none'
        these.style.display = ''
    })
})

elementProperty.addEventInElement('#search-product','oninput',function (){
    let that = this.value;
    elementProperty.getElement('.product', products => {
        let product = products.getAttribute('title').toUpperCase();
        if(!product.includes(that.toUpperCase()))
            return products.style.display = 'none'
        return products.style.display = ''
    })
})
