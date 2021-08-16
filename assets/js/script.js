document.addEventListener('DOMContentLoaded', () => {
    


    const btnLogin = document.getElementById('login_view');

    
    
    const formLogout = document.getElementById('form_logout');
    
    if(formLogout){
        formLogout.addEventListener('submit', function (e) {
            // e.preventDefault();
            const formDataLogout = new FormData(this);
            formDataLogout.append('type', 'logout')
    
            ajaxSend(formDataLogout)
                .then((response) => {
                    res = JSON.parse(response);
                    document.getElementById('message').innerHTML = res.message;
                    window.location.reload();
                })
                .catch((err) => console.error(err))
        });
    }
        
    
    
    
    if(btnLogin){
        btnLogin.addEventListener('click', function (e){
            document.getElementById('login_form').classList.toggle('hidden');
        })
    }
    

    const formLogin = document.getElementById('form_login');
    
    if(formLogin){
        formLogin.addEventListener('submit', function(e){
            e.preventDefault();
            const formLoginData = new FormData(this);
            formLoginData.append('type', 'login')

            ajaxSend(formLoginData)
                .then((response) => {
                    res = JSON.parse(response);
                    if (res.status == 'ok') {
                        window.location.reload();
                    }else{
                        document.getElementById('message').innerHTML = res.message;
                        formLogin.reset(); // очищаем поля формы 
                    }
                    
                    
                })
                .catch((err) => console.error(err))
        });
    }
       
 
   
    
    
    let tree = document.getElementById('tree');
    
       
        //  ловим клики на всём дереве
        tree.onclick = function(event) {
          if (event.target.tagName != 'SPAN') {
            return;
            
          }
          console.log(event.target.tagName);
    
          let childrenContainer = event.target.parentNode.querySelector('ul');
          console.log(childrenContainer);
          if (!childrenContainer) return; // нет детей
    
          childrenContainer.classList.toggle('hidden');
        }
    
    });




    function deleteData(id,name){
        let modal = document.getElementById('modal_delete');
        let btndelete = document.getElementById('btn_delete_yes');
        document.getElementById('modal_delete_message').innerHTML = "Удалить элемент \"" + name + "\"?";
        btndelete.setAttribute("onclick", `deleteYes(${id})`);
        modal.classList.toggle('hidden');
    }

    function deleteYes(id){
        formData = new FormData();
        formData.append('type', 'delete');
        formData.append('id', id);

        ajaxSend(formData)
                .then((response) => {
                    res = JSON.parse(response);
                    if (res.status == 'ok') {
                        window.location.reload();
                    }else{
                        //document.getElementById('message').innerHTML = res.message;
                        console.log(res);
                    }
                    
                    
                })
                .catch((err) => console.error(err))
        
    }

    function createData(parentid){
        let modal = document.getElementById('modal_create');
        let btndelete = document.getElementById('btn_create_yes');
        
        btndelete.setAttribute("onclick", `createYes(${parentid},)`);
        modal.classList.toggle('hidden');
    }

    function createYes(parentid){
        let name = document.getElementById('create_name').value;
        let description = document.getElementById('create_description').value;
        formData = new FormData();
        formData.append('type', 'create');
        formData.append('parentid', parentid);
        formData.append('name', name);
        formData.append('description', description);

        ajaxSend(formData)
                .then((response) => {
                    res = JSON.parse(response);
                    if (res.status == 'ok') {
                        window.location.reload();
                    }else{
                        //document.getElementById('message').innerHTML = res.message;
                        console.log(res);
                    }
                    
                    
                })
                .catch((err) => console.error(err))
        
    }

    function updateData(id,name){
        let modal = document.getElementById('modal_update');
        let btnupdate = document.getElementById('btn_update_yes');
        document.getElementById('modal_update_message').innerHTML = "Обновить элемент \"" + name + "\"?";
        btnupdate.setAttribute("onclick", `updateYes(${id},)`);
        modal.classList.toggle('hidden');
    }

    function updateYes(id){
        let name = document.getElementById('update_name').value;
        let description = document.getElementById('update_description').value;
        formData = new FormData();
        formData.append('type', 'update');
        formData.append('id', id);
        formData.append('name', name);
        formData.append('description', description);

        ajaxSend(formData)
                .then((response) => {
                    res = JSON.parse(response);
                    if (res.status == 'ok') {
                        window.location.reload();
                    }else{
                        //document.getElementById('message').innerHTML = res.message;
                        console.log(res);
                    }
                    
                    
                })
                .catch((err) => console.error(err))
        
    }


    function closeModal(modal_id){
        document.getElementById(modal_id).classList.toggle('hidden');
    }
    

    const ajaxSend = async (formData) => {
        const fetchResp = await fetch('controllers/post.php', {
            method: 'POST',
            body: formData
        });
        if (!fetchResp.ok) {
            throw new Error(`Ошибка по адресу ${url}, статус ошибки ${fetchResp.status}`);
        }
        return await fetchResp.text();
    };