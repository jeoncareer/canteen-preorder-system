<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Canteen - Preorder System</title>

    <link rel="stylesheet" href="<?= ROOT ?>assets/css/index.css">



</head>

<body>
    <div class="app-container">
        <!-- Header -->
        <!-- ?php $page = 'menu' ;
    require __DIR__ .'/../header.view.php';?  -->

        <?php
        require 'header.view.php';
        ?>

        <div class="main-content">
            <!-- Sidebar Navigation -->

            <?php require 'sidebar.view.php'; ?>

            <!-- Content Area -->
            <div class="content-area">
                <!-- Menu Page -->
                <div id="menu-page" class="page active">
                    <div class="page-title">
                        <span>🍽️</span>
                        <span>Today's Menu</span>
                    </div>

                    <input type="text" class="search-bar" placeholder="Search for dishes..." id="searchInput" oninput="searchItems()">

                    <div class="menu-grid">
                        <div class="menu-categories">
                            <!-- Main Course -->
                            <?php foreach ($grouped as $key => $values): ?>
                                <div class="category-section">
                                    <h2 class="category-title">
                                        <span>🍛</span>
                                        <span><?= $key ?></span>
                                    </h2>
                                    <div class="menu-items-grid">
                                        <?php foreach ($values as $value): ?>


                                            <div class="menu-item" data-ite="biryani" data-price="85" data-name="Chicken Biryani">
                                                <div class="item-header">
                                                    <div class="item-name"><?= ucwords($value->item_name) ?></div>
                                                    <div class="item-price">₹<?= $value->price ?></div>
                                                </div>
                                                <div class="item-description">Fragrant basmati rice with tender chicken, aromatic spices, and boiled egg. Served with raita and pickle.</div>
                                                <div class="item-footer">
                                                    <div class="availability available">Available</div>
                                                    <?php if (!$value->in_cart): ?>
                                                        <button data-price="<?= $value->price ?>" data-name="<?= ucwords($value->item_name) ?>" data-item-id="<?= $value->item_id ?>" class="addCart-btn">
                                                            add to Cart
                                                        </button>
                                                    <?php else: ?>
                                                        <button data-price="<?= $value->price ?>" data-name="<?= ucwords($value->item_name) ?>" data-item-id="<?= $value->item_id ?>" class="addCart-btn-success">
                                                            Added To Cart
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>



                                    </div>
                                </div>

                            <?php endforeach; ?>




                        </div>


                        <form action="<?= ROOT ?>students/order">


                            <div class="cart-panel">
                                <div class="cart-header">
                                    <span class="cart-title">🛒 Your Order</span>
                                </div>
                                <div class="cart-items cart-item-template" id="cart-items">
                                    <?php if (!empty($carts)): ?>
                                        <?php foreach ($carts as $cart): ?>
                                            <div class="cart-item">

                                                <div class="item-details">
                                                    <div class="item-name"><?= ucfirst($cart->name) ?></div>
                                                    <div class="item-price">₹<?= $cart->price ?> each</div> <?php $total += ($cart->price * $cart->count) ?>
                                                    <div class="quantity-controls">
                                                        <button data-item-id="<?= $cart->item_id ?>" class="quantity-btn">−</button>
                                                        <span data-item-id="<?= $cart->item_id ?>" class="quantity"><?= $cart->count ?></span>
                                                        <button data-price="<?= $cart->price ?>" data-item-id="<?= $cart->item_id ?>" class="quantity-btn">+</button>
                                                    </div>
                                                </div>
                                                <div class="item-total"><span>₹</span>
                                                    <div data-item-id="<?= $cart->item_id ?>" class="total-price"><?= $cart->price * $cart->count ?></div>
                                                </div>
                                                <button class="remove-btn" onclick="removeItem(this)">×</button>
                                            </div>


                                        <?php endforeach; ?>
                                    <?php endif; ?>




                                    <div class="cart-summary" id="cart-summary">
                                        <div class="summary-row">
                                            <span>Subtotal:</span>
                                            <span id="subtotal">₹210</span>
                                        </div>
                                        <div class="summary-row">
                                            <span>Tax (5%):</span>
                                            <span id="tax">₹10.50</span>
                                        </div>
                                        <div class="summary-row summary-total">
                                            <span>Total:</span>
                                            <span id="total">₹<?= $total ?></span>
                                        </div>
                                        <button class="checkout-btn" id="checkout-btn" onclick="checkout()">
                                            Place Order
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>





</body>

<script>
    cartUpdateQuantity();
    const buttons = document.querySelectorAll(".addCart-btn");

    buttons.forEach(button => {
        button.addEventListener("click", function() {

            const itemId = this.dataset.itemId;
            const price = this.dataset.price;

            const name = this.dataset.name;
            const url = '<?= ROOT ?>students/addToCart';

            fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        item_id: itemId

                    })
                })
                .then(res => res.json())
                .then(data => {
                    console.log("response:", data);
                    if (data.success) {
                        console.log("item added to cart!");

                        // Only then append new cart item
                        const cartItems = document.getElementById("cart-items");
                        const cartSummary = document.getElementById("cart-summary");
                        const cartHTML = `
                                <div class="cart-item">

                                    <div class="item-details">
                                        <div class="item-name">${name.charAt(0).toUpperCase() + name.slice(1)}</div>
                                        <div class="item-price">₹${price} each</div>
                                        <div class="quantity-controls">
                                            <button data-item-id="${itemId}" class="quantity-btn">−</button>
                                            <span data-item-id="${itemId}" class="quantity">1</span>
                                            <button data-price="${price}" data-item-id="${itemId}" class="quantity-btn">+</button>
                                        </div>
                                    </div>

                                    <div class="item-total"><span>₹</span>
                                        <div data-item-id="${itemId}" class="total-price">${price}</div>
                                    </div>

                                    <button class="remove-btn" onclick="removeItem(this)">×</button>
                                </div>
                            `;

                        const tempDiv = document.createElement("div");
                        tempDiv.innerHTML = cartHTML.trim();
                        const newCartItem = tempDiv.firstChild;

                        cartItems.insertBefore(newCartItem, cartSummary);

                        button.disabled = true;

                        // Change appearance and text
                        button.classList.remove('addCart-btn');
                        button.classList.add('addCart-btn-success');
                        button.textContent = 'Added To Cart';
                        cartUpdateQuantity();

                    } else {
                        console.log("failed to add to cart.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
        });
    });

    function cartUpdateQuantity() {


        const cartUpdateButtons = document.querySelectorAll('.quantity-btn');

        cartUpdateButtons.forEach(button => {
            button.addEventListener("click", function() {
                event.preventDefault();

                const itemId = this.dataset.itemId;
                const sign = this.textContent.trim();
                const price = parseInt(this.dataset.price);

                const el = document.querySelector(`.quantity[data-item-id="${itemId}"]`);
                const totalPrice = document.querySelector(`.total-price[data-item-id="${itemId}"]`);
                let count = parseInt(el.textContent.trim());





                let url = "<?= ROOT ?>students/update_quantity";
                fetch(url, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            item_id: itemId,
                            sign: sign
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log("response", data);
                        if (data.success) {
                            el.textContent = data.count;
                            totalPrice.textContent = data.count * price;

                        }
                    });




                console.log("you pressed " + itemId + ": sign:" + sign);

            });
        });
    }
</script>




</html>