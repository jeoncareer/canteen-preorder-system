  let table = document.querySelector('.orders-table');
        let tBody = table.querySelector('tbody');
        
        // console.log(orders);
        let checkboxs = document.querySelectorAll('.order-checkbox[data-order-id]');
        checkboxs.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                let orderId = checkbox.dataset.orderId;
                console.log("clicked checkbox with id " + orderId);
            })
        })


        let allCheckbox = document.getElementById('selectAllHeader');

        allCheckbox.addEventListener('change', function() {
            checkboxs.forEach(checkbox => {
                checkbox.checked = allCheckbox.checked;
                let orderId = checkbox.dataset.orderId;
                console.log(" checkbox: " + orderId);
            })
        })

        let bulkBtns = document.querySelectorAll('.bulk-btn');

        bulkBtns.forEach(bulkBtn => {
            bulkBtn.addEventListener('click', function() {
                let newStatus = bulkBtn.dataset.type;
                checkboxs.forEach(checkbox => {
                    if (checkbox.checked) {


                        let orderId = checkbox.dataset.orderId;
                        console.log("changing " + orderId);
                        const url = ROOT + 'api/changeStatus';
                        fetch(url, {
                                method: "POST",
                                headers: {
                                    "Content-type": "application/json"
                                },
                                body: JSON.stringify({
                                    order_id: orderId,
                                    new_status: newStatus
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    let select = document.querySelector(`.status-select[data-id="${orderId}"]`);
                                    console.log(select);
                                    select.classList.remove('pending', 'accepted', 'completed', 'rejected', 'ready');
                                    select.classList.add(newStatus);
                                    select.value = newStatus;
                                    console.log("Status updated successfully");

                                }
                            });
                    }
                })
            })
        })


        const selects = document.querySelectorAll('.form-select,.form-input');
        selects.forEach(select => {
            select.addEventListener('change', function() {

                let filter = [];

                selects.forEach(select => {
                    filter.push({
                        type: select.dataset.type,
                        value: select.value


                    })

                })

                const url = ROOT + "api/getOrdersByFilter";

                console.log(filter[4].type);
                fetch(url, {
                        method: "POST",
                        headers: {
                            "Content-type": "application/json"
                        },
                        body: JSON.stringify({
                            filter: filter
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            console.log("after backend calling");

                            let orders = data.orders;
                            // let testing = document.querySelector('#testing');
                            // testing.innerHTML = `<pre>${JSON.stringify(orders, null, 2)}</pre>`;
                            tBody.innerHTML = '';
                            console.log(data.sql);
                            console.log(orders);
                            console.log(filter[4].value);
                            if (filter[4].value !== "") {
                                if (filter[4].value === 'desc') {
                                    Object.entries(orders).sort((a, b) => b[0] - a[0]).forEach(([orderId, items]) => {

                                        filterOrders(orderId, items);

                                    })
                                } else if (filter[4].value === 'asc') {
                                    Object.entries(orders).sort((a, b) => a[0] - b[0]).forEach(([orderId, items]) => {

                                        filterOrders(orderId, items);

                                    })
                                } else if (filter[4].value === 'total') {
                                    Object.entries(orders)
                                        .sort((a, b) => b[1][0].total - a[1][0].total)
                                        .forEach(([orderId, items]) => {
                                            filterOrders(orderId, items);
                                        });

                                }
                            } else {
                                console.log("in else");

                                Object.entries(orders).forEach(([orderId, items]) => {

                                    filterOrders(orderId, items);

                                })
                            }

                        } else {
                            tBody.innerHTML = '';
                        }
                    });


                //table.removeChild(tbody);



            })
        })

        function filterOrders(orderId, items) {
            let tr = document.createElement('tr');
            let itemsCount = '';
            items.forEach(item => {
                let name = item.name;
                name = name.charAt(0).toUpperCase() + name.slice(1);
                itemsCount += `
                                       <div class="order-item">
                                <span class="item-name">${name}</span>
                                <span class="item-quantity">x${item.quantity}</span>
                                </div>
                                    `;
            });

            let time = items[0].time;
            const dateStr = time;
            const date = new Date(dateStr.replace(" ", "T"));

            const options = {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            }

            const dateOptions = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            const formattedTime = date.toLocaleTimeString('en-US', options);
            const realDate = date.toLocaleDateString('en-US', dateOptions);


            tr.innerHTML = `
                                
                                <td>
                                <input type="checkbox" class="order-checkbox" data-order-id="${items[0].id}">
                                </td>
                                <td><span class="order-id">#${items[0].id}</span></td>
                                <td>
                                <div class="student-info">
                                <span class="student-name">${items[0].email}</span>
                                <span class="student-email">${items[0].email}</span>
                                </div>
                                </td>
                                <td>
                                <div class="order-items-list">
                                
                             ${itemsCount}
                                
                                
                                </div>
                                </td>
                                <td><span class="order-total">₹${items[0].total}</span></td>
                                <td>
                                <div class="order-time-info">
                                <span class="order-time">${formattedTime}</span>
                                <span class="order-date">${realDate}</span>
                                </div>
                                </td>
                                <td>
                                <select data-id='${items[0].id}' class="status-select ${items[0].status}">
                                <option value="pending" ${items[0].status === 'pending' ? 'selected' : ''}>Pending</option>
                                <option value="accepted" ${items[0].status === 'accepted' ? 'selected' : ''}>Accepted</option>
                                <option value="completed" ${items[0].status === 'completed' ? 'selected' : ''}>Completed</option>
                                <option value="ready" ${items[0].status === 'ready' ? 'selected' : ''}>Ready</option>
                                <option value="rejected" ${items[0].status === 'rejected' ? 'selected' : ''}>Rejected</option>
                                </select>
                                </td>
                                <!-- <td>
                                <div class="order-actions">
                                <button class="order-action-btn view-details-btn">👁️ Details</button>
                                </div>
                                </td> -->
                                
                                `;

            tBody.append(tr);
        }
    