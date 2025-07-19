// Status change functionality
    setInterval(updateOrders, 60000);
    document.addEventListener('change', function(e) {
      if (e.target && e.target.classList.contains('status-select')) {
        const select = e.target;
        const orderId = select.dataset.id;
        const newStatus = select.value;

        // Remove all status classes
        select.classList.remove('pending', 'accepted', 'completed', 'rejected');

        // Add the new status class
        select.classList.add(newStatus);

        console.log(`Order ${orderId} status changed to: ${newStatus}`);

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
              console.log("Status updated successfully");
            }
          });

        showStatusChangeMessage(orderId, newStatus);
      }
    });


    // Function to show status change message
    function showStatusChangeMessage(orderId, status) {
      // Create a temporary notification
      const notification = document.createElement('div');
      notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #27ae60;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        z-index: 10000;
        font-weight: 600;
        animation: slideIn 0.3s ease;
      `;

      notification.textContent = `Order ${orderId} status updated to ${status.toUpperCase()}`;
      document.body.appendChild(notification);

      // Remove notification after 3 seconds
      setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
          document.body.removeChild(notification);
        }, 300);
      }, 3000);
    }

    // Add CSS animations for notifications
    const style = document.createElement('style');
    style.textContent = `
      @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
      }
      @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
      }
    `;
    document.head.appendChild(style);


    function updateOrders() {

      const el = document.querySelector('.order-id');
      orderId = el.dataset.orderId;
      const url = ROOT + 'api/updateOrders';
      fetch(url, {
          method: "POST",
          headers: {
            "Content-type": "application/json"
          },
          body: JSON.stringify({
            order_id: orderId
          })
        })
        .then(res => res.json())
        .then(data => {

          if (data.success) {

            const orders = data.orders;
            console.log(orders);

            Object.entries(orders).forEach(([orderId, items]) => {
              console.log("Order ID:", orderId);

              let OrderITems = "";

              items.forEach(item => {
                let name = item.name;
                name = name.charAt(0).toUpperCase() + name.slice(1);
                OrderITems = OrderITems + name + " x" + item.quantity + ",";
              });



              console.log(OrderITems);
              console.log(orderId);

              const OrderHtml = `
                          <td><span data-order-id="${orderId}" class="order-id">#${orderId}</span></td>
                              <td><span class="student-name">${items[0].student_id}</span></td>
                              <td><span class="order-items"> ${OrderITems}</span></td>
                              <td>
                            <select data-id='${items[0].id}' class="status-select ${items[0].status}">
                            <option value="pending" ${items[0].status === 'pending' ? 'selected' : ''}>Pending</option>
                            <option value="accepted" ${items[0].status === 'accepted' ? 'selected' : ''}>Accepted</option>
                            <option value="completed" ${items[0].status === 'completed' ? 'selected' : ''}>Completed</option>
                            <option value="rejected" ${items[0].status === 'rejected' ? 'selected' : ''}>Rejected</option>
                          </select>

                              </td>
                              <td><span class="order-time">test</span></td>
    
                          `;
              let tr = document.createElement('tr');
              tr.innerHTML = OrderHtml;
              const tBody = document.querySelector('.orders-table tbody');
              tBody.prepend(tr);
            });


          }
        });





    }
