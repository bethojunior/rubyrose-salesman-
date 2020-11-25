elementProperty.addEventInElement('.delete-type','onclick',function (){
    let id = this.getAttribute('id');
    SwalCustom.dialogConfirm('Deseja deletar esse tipo de produto?','Essa ação é irreversivel',status => {
        if(!status)
            return false;

        TypeProductController.delete(id).then(response => {
            if(response.status){
                elementProperty.getElement(`.type-${id}`,that => {
                    that.style.display = 'none';
                })
                return swal('Excluido com sucesso', '', 'success');
            }
            return swal('Erro ao excluir','Contate o suporte','info');
        })
    })
})
