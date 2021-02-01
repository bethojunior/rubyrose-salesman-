$('.carousel').carousel({
    interval: 2000
})

let UserLogged;
let products = [];

elementProperty.getElement('#user-logged', user => {
    UserLogged = JSON.parse(user.value);
})

elementProperty.addEventInElement('.add-bag','onclick',function (){
    let product = JSON.parse(this.getAttribute('data'));
    let id = product.id;
    let name = product.name;
    let value = parseFloat(product.value);
    elementProperty.getElement(`#qtd-${id}`,product => {
        SwalCustom.dialogConfirm('Adicionar a sacola',`Tem certeza que deseja adicionar ${product.value} unidades de ${name} a sua sacola?`, status => {
            if(!status)
                return false;

            let data = {
                'amount' : parseInt(product.value),
                'product_id' :  id,
                'user_id' : UserLogged.id,
                'name'    : name,
                'value'   : value,
            };
            products.push(data);
            swal(`${product.value} unidades de ${name} adicionado a sua sacola com sucesso`,'','success');
        })

    });
})

elementProperty.addEventInElement('.add-item','onclick',function (){
    let data = JSON.parse(this.getAttribute('product'));
    let minimum_order = data.minimum_order;

    let id = data.id;
    elementProperty.getElement(`#qtd-${id}`, product => {
        let actualValue = parseInt(product.value);
        product.value = (actualValue + minimum_order);
    });
})

elementProperty.addEventInElement('.remove-item','onclick',function (){
    let data = JSON.parse(this.getAttribute('product'));
    let id = data.id;
    let min = parseInt(data.minimum_order);

    elementProperty.getElement(`#qtd-${id}`,product => {
        let actualValue = parseInt(product.value);
        let qtd = product.value = (actualValue - min);
        if(qtd > min)
            return true;//SwalCustom.toast('1 item | ' + data.name+' removido a sua sacola','','','');
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

elementProperty.addEventInElement('.finish-bag','onclick',function (){
    if(products.length === 0)
        return swal('Você não tem itens adicionado a seu carrinho','','info');
    $('#modal-orders').modal('show')
    elementProperty.getElement('#mount-orders', these => {
        let content = '';
        let value = '';
        content += products.map(product => {
            console.log(product)
            value += (parseFloat(product.value) * parseInt(product.amount))
            return `
                <div id="" class="row col-lg-12 col-sm-12 card pt-2 pl-2 pb-2 product-${product.product_id}">
                    <p>
                        Produto : ${product.name}
                    </p>
                    <p>
                        Quantidade : ${product.amount} unidades
                    </p>
                    <p>
                        Valor uniátio : R$ ${product.value}
                    </p>
                    <p>
                        Valor total: R$ ${ (parseFloat(product.value) * parseFloat(product.amount)) }
                    </p>
                    <div class="col-sm-12 col-lg-12">
                        <button name="${product.name}" id="${product.product_id}" class="col-lg-12 col-sm-12 btn btn-outline-danger remove-item-order">
                            Remover do carrinho
                        </button>
                    </div>
                </div>
            `;
        }).join('');
        these.innerHTML = content;
        console.log(value);
        elementProperty.addEventInElement('.remove-item-order','onclick',function (){
            let name = this.getAttribute('name');
            SwalCustom.dialogConfirm(`Deseja remover ${name} do carrinho ?`,'',status => {
                if(!status)
                    return false;

                let id = this.getAttribute('id');

                products.map((product , j) => {
                    if(product.product_id === parseInt(id)){
                        let name = product.name;
                        products.splice(products.indexOf(product), 1);
                        elementProperty.getElement('.product-'+id,these => {
                            these.style.display = 'none';
                        })
                        return swal(`${name} removido`,'','info')
                    }
                })

            })
        });
    })
})

elementProperty.addEventInElement('#send-order','onclick',function (){
    $('#modal-orders').modal('hide')
    SwalCustom.dialogConfirm('Deseja finalizar seu pedido?','',status => {
        if(!status)
            return false;

        let formData = new FormData();
        formData.append('sales', 'products');
        SalesController.create(products).then(response => {
            SalesController.getPhone().then(callback => {
                let phone = callback.response;
                phone = phone.phone;
                let data = response.response;
                if(!response.status)
                    return swal('Erro ao inserir suas vendas','Contate o fornecedor','info')

                products = [];
                swal('Venda enviada','Em 5 segundos você será redirecionado para um represetante comercial via whatspp para finalizar sua venda','success');
                setTimeout(() => {
                    window.location.href = 'https://api.whatsapp.com/send?phone='+phone+'&text=Ol%C3%A1%2C%20o%20numero%20do%20meu%20pedido%20'+data.sale_id;
                },2000)
            })
        })
    })
})

elementProperty.addEventInElement('#cancel-order','onclick',function (){
    SwalCustom.dialogConfirm('Deseja esvaziar seu carrinho?','',status => {
        if(!status)
            return true;

        $('#modal-orders').modal('hide')
        swal('Carrinho vazio');
        products = [];

    })
})
