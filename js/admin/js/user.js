const BASE_URL = 'http://localhost/api/admin'

function get_user_list() {
    $.getJSON(BASE_URL + '/user/index.php', function (data) {
        let user_list = JSON.parse(data)
        render_user(user_list)
    })
}
function render_user(user_list) {
    let dom_user = document.getElementById('user_list')
    dom_user.innerHTML = '';

    user_list.forEach(user => {
        let user_node = create_user_node(user)
        dom_user.appendChild(user_node)
    });
}
function create_user_node(user) {
    let root = document.createElement('tr')

    let user_id = document.createElement('td')
    user_id.textContent = user.id
    root.appendChild(user_id)

    let user_email = document.createElement('td')
    user_email.textContent = user.email
    root.appendChild(user_email)


    let user_password = document.createElement('td')
    user_password.textContent = user.password
    root.appendChild(user_password)

    let user_role = document.createElement('td')
    user_role.textContent = user.role
    root.appendChild(user_role)

    let wrap_btn_edit = document.createElement('td')
    let btn_edit = document.createElement('button')
    btn_edit.innerText = "Edit"
    btn_edit.setAttribute("class", "btn-primary")

    btn_edit.onclick = function () {
        open_edit(user.id)
    }

    wrap_btn_edit.appendChild(btn_edit)

    root.appendChild(wrap_btn_edit)

    let wrap_btn_delete = document.createElement('td')
    let btn_delete = document.createElement('button')
    btn_delete.innerText = "Delete"
    btn_delete.setAttribute("class", "btn-danger")
    btn_delete.onclick = function () {
        delete_users(user.id)
    }
    wrap_btn_delete.appendChild(btn_delete)

    root.appendChild(wrap_btn_delete)

    return root
}
function delete_users(id) {
    $.getJSON(BASE_URL + '/user/delete.php?id=' + id, function (data) {
        if (data.status == true) {
            location.reload();
        } else {
            alert('delete successfully')
        }
    })
}
function open_edit(id) {
    window.location.href = 'edit.html?id=' + id
}

//Create Category

function doCreate() {
    let email = document.getElementById("email").value
    let password = document.getElementById("password").value
    let role = document.getElementById("role").value
   
    create_users(email,password,role)
}

function create_users(email,password,role) {
    let params = { 'email': email, 'password':password,'role':role}
    $.post(BASE_URL + '/user/create.php', params, function(data){
        if (data.status == true) {
            window.location.href = 'index.html'
        } else {
            alert('create successfully')
        }
    })
}

function edit_users(id){
    $.getJSON(BASE_URL + '/user/show.php?id=' + id, function (res) {  
        let user = res.data      
        let dom_email = document.getElementById("email")
        dom_email.value = user.email

        let dom_role = document.getElementById("role")
        dom_role.value = user.role

        let dom_password = document.getElementById("password")
        dom_password.value = user.password

    })
}

function doUpdate(){
    let email = document.getElementById("email").value
    let password = document.getElementById("password").value
    let role = document.getElementById("role").value
    update_user(id, email,role,password)
}

function update_user(id, email,role,password){
    let params = {'id': id,
    'email': email,
    'role':role,
    'password':password
}
    $.post(BASE_URL + '/user/update.php', params, function(data){
        if (data.status == true) {
            window.location.href = 'index.html'
        } else {
            alert('edit successfully')
            window.location.href = 'index.html'
            
        }
    })
}