elementProperty.addEventInElement('.delete-user','onclick',function (){
    let id = this.getAttribute('id');
    SwalCustom.dialogConfirm('Deseja desativa esse usuário?','Essa ação é irreversivel', status =>{
        if(!status)
            return false;

        UserController.delete(id).then(response => {
            if(response.status){
                elementProperty.getElement(`.user-${id}`,that => {
                    that.style.display = 'none';
                })
                return swal('Usuário excluido com sucesso', '', 'success');
            }
            return swal('Erro ao excluir usuário','Contate o suporte','info');
        })

    })
})
