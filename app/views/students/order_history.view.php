<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Order History</title>
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/student-general.css">
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/order-history.css">
    <script>
        const ROOT = "<?= ROOT ?>";
    </script>
</head>

<body>
    <?php require 'header.view.php' ?>

    <div class="container">
        <?php
        $page = 'order_history';
        require 'sidebar.view.php';
        ?>

        <div class="main-content">
            <div class="page-header">
                <h2>Order History</h2>
            </div>





            <div class="history-section">
                <div class="section-title">Recent Orders</div>

                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $row): ?>
                        <div class="order-card">
                            <div class="order-header">
                                <div>
                                    <div class="order-id">Order #<?= $row->id ?></div>
                                    <div class="order-date"><?= $row->time ?></div>
                                </div>
                                <div class="order-status status-<?= $row->status ?>"><?= $row->status ?></div>
                            </div>

                            <div class="order-items">
                                <?php foreach ($row->items as $item): ?>
                                    <div class="order-item">
                                        <div class="item-details">
                                            <div class="item-name"><?= $item->item->name ?></div>
                                            <div class="item-specs">Qty: <?= $item->quantity ?> </div>

                                        </div>
                                        <div class="item-price">₹<?= $item->item->price ?></div>
                                    </div>
                                <?php endforeach; ?>


                            </div>

                            <div class="order-footer">
                                <div class="order-info">

                                    <div>Payment: COD</div>
                                </div>
                                <div class="order-total">Total: ₹<?= $row->total ?></div>
                                <!-- <div class="order-actions">
                                    <button class="btn btn-outline">Reorder</button>
                                    <button class="btn btn-secondary">View Receipt</button>
                                </div> -->
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

        </div>


    </div>


    <script>
        const filterTabs = document.querySelectorAll('.filter-tab');

        filterTabs.forEach(btn => {
            btn.addEventListener('click', e => {


                let status = btn.dataset.status;
                console.log(status);
                const url = ROOT + 'OrdersController/studentOrders/' + status;
                if (status == '') {
                    status = 'Recent';
                }

                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            let orders = data.orders;
                            let historySection = document.querySelector('.history-section');
                            if (orders) {

                                historySection.innerHTML = '';

                                orders.forEach(order => {
                                    let orderCard = document.createElement('div');
                                    orderCard.classList.add('order-card');
                                    orderCard.innerHTML = `
                                          <div class="order-header">
                                <div>
                                    <div class="order-id">Order #${order.id}</div>
                                    <div class="order-date">${formatDateTime(order.time)}</div>
                                </div>
                                <div class="order-status status-${order.status}">${order.status}</div>
                            </div>

                            <div class="order-items">



                            </div>

                            <div class="order-footer">
                                <div class="order-info">

                                    <div>Payment: Wallet</div>
                                </div>
                                <div class="order-total">Total: ₹${order.total}</div>
                                <div class="order-actions">
                                    <button class="btn btn-outline">Reorder</button>
                                    <button class="btn btn-secondary">View Receipt</button>
                                </div>
                            </div>
                                    `;

                                    historySection.appendChild(orderCard);
                                    let orderItemsCard = orderCard.querySelector('.order-items');
                                    let orderItems = order.order_items;
                                    orderItems.forEach(or => {

                                        let orderItemCard = document.createElement('div');
                                        orderItemCard.classList.add('order-item');
                                        orderItemCard.innerHTML = `
                                         <div class="item-details">
                                            <div class="item-name">${or.item.name}</div>
                                            <div class="item-specs">Qty: ${or.quantity} </div>
                                            <div class="rating-stars">⭐⭐⭐⭐⭐</div>
                                        </div>
                                        `;
                                        orderItemsCard.appendChild(orderItemCard);
                                    })

                                })
                            }

                            let sectionTitle = document.createElement('div');
                            sectionTitle.classList.add('section-title');
                            sectionTitle.innerHTML = `${status} Orders`;
                            historySection.prepend(sectionTitle);
                        }

                    })


                activeFilterTab = document.querySelector('.filter-tab.active');
                if (activeFilterTab) {
                    activeFilterTab.classList.remove('active');
                }
                btn.classList.add('active');

            })
        })


        function formatDateTime(mysqlTime) {
            const date = new Date(mysqlTime.replace(" ", "T"));
            return date.toLocaleString("en-US", {
                weekday: "short",
                year: "numeric",
                month: "short",
                day: "numeric",
                hour: "numeric",
                minute: "2-digit"
            });
        }

        console.log(formatDateTime("2025-09-04 15:25:44"));
    </script>
</body>

</html>