class OrderDetail {
    constructor(product_id, product_name, product_unit, product_quantity, product_price) {
        this.product_id = product_id
        this.product_name = product_name
        this.product_unit = product_unit
        this.product_quantity = product_quantity
        this.product_price = product_price
    }
}
var order = []
function add_to_order(order_detail) {
    //create new or update
    var product_exist = false
    for(let i = 0; i < order.length; i++){
        if(order[i].product_id == order_detail.product_id){
            order[i].product_quantity += 1
            product_exist = true
            break;
        }
    }

    if(!product_exist)
        order.push(order_detail)

    render_order()
}

function render_order() {
    let dom_order = document.getElementById('order')
    dom_order.innerHTML = ''

    let index = 0
    order.forEach(order_detail => {
        index++
        let order_detail_node = create_order_detail_node(index, order_detail)
        dom_order.appendChild(order_detail_node)

        order_detail_node.onclick = function () {

        }
    });
}


function create_order_detail_node(index, order_detail) {
    let root = document.createElement('tr')
    console.log(order_detail)

    // Begin stt
    let order_detail_stt = document.createElement('td')
    order_detail_stt.innerText = index
    root.append(order_detail_stt)
    // End stt

    // Begin name
    let order_detail_name = document.createElement('td')
    order_detail_name.innerText = order_detail.product_name
    root.append(order_detail_name)
    // End name

    // Begin uni
    let order_detail_unit = document.createElement('td')
    order_detail_unit.innerText = order_detail.product_unit
    root.append(order_detail_unit)
    // End unit

    // Begin quantity
    let product_quantity_wrap = document.createElement('td')
    product_quantity_wrap.setAttribute('class', 'input-number')
    root.appendChild(product_quantity_wrap)

    let product_quantity_minus = document.createElement('button')
    product_quantity_minus.innerText = '-'
    product_quantity_minus.onclick = function () {
        update_order_detail(order_detail, -1)
        render_order()
    }
    product_quantity_wrap.appendChild(product_quantity_minus)

    let product_quantity = document.createElement('input')
    product_quantity.setAttribute('type', 'number')
    product_quantity.setAttribute('min', 1)
    product_quantity.setAttribute('max', 1)
    product_quantity.value = order_detail.product_quantity
    product_quantity_wrap.appendChild(product_quantity)

    let product_quantity_plus = document.createElement('button')
    product_quantity_plus.innerText = '+'
    product_quantity_plus.onclick = function () {
        update_order_detail(order_detail, 1)
        render_order()
    }
    product_quantity_wrap.appendChild(product_quantity_plus)
    // End quantity

    // Begin price
    let order_detail_price = document.createElement('td')
    order_detail_price.innerText = order_detail.product_price
    root.append(order_detail_price)
    // End price

    // Begin total
    let order_detail_total_price = document.createElement('td')
    order_detail_total_price.innerText = order_detail.product_price * order_detail.product_quantity + ''
    root.append(order_detail_total_price)
    
    // End total

    // Begin button delete 
    let order_detail_trash_wrap = document.createElement('td')
    let order_detail_trash = document.createElement('span')
    order_detail_trash.setAttribute('class', 'btn-delete ti-trash')
    order_detail_trash_wrap.append(order_detail_trash)
    order_detail_trash.onclick = function () {
        remove_order_detail(order_detail)
        render_order()
    }

    function sumtotal(s){
        s = order_detail.product_price * order_detail.product_quantity 
        root.append(order_detail_total_price)
    }

    sumtotal(0);

    root.append(order_detail_trash_wrap)
    // End delete

    return root;
}
/**
 * Xóa
 */
function remove_order_detail(order_detail) {
    for (let i = 0; i < order.length; i++) {
        if (order[i].product_id == order_detail.product_id) {
            order.splice(i, 1)
            break;
        }
    }
}
/**
 * Update
 */
function update_order_detail(order_detail, quantity) {
    for (let i = 0; i < order.length; i++) {
        if (order[i].product_id == order_detail.product_id) {
            order[i].product_quantity += quantity
            if (order[i].product_quantity < 1)
                order[i].product_quantity = 1
            break;
        }
    }
}

