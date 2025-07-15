    updateAddButton();
    cartUpdateQuantity();
    addToCart();

    function addToCart() {


        document.addEventListener("click", function(event) {
            if (event.target.classList.contains("addCart-btn")) {
                const button = event.target;
                const itemId = button.closest(".menu-item").dataset.itemId;
                const itemName = button.closest(".menu-item").querySelector(".item-name").textContent;
                const itemPrice = button.closest(".menu-item").querySelector(".item-price").textContent.replace(/[^\d]/g, '');

                const url = ROOT + 'api/addToCart';

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
                        if (data.success) {
                            const cartItems = document.getElementById("cart-items");
                            const cartSummary = document.getElementById("cart-summary");

                            const cartHTML = `
                    <div class="cart-item">
                        <div class="item-details">
                            <div class="item-name">${itemName}</div>
                            <div class="item-price">₹${itemPrice} each</div>
                            <div class="quantity-controls">
                                <button data-item-id="${itemId}" data-price="${itemPrice}" class="quantity-btn">−</button>
                                <span data-item-id="${itemId}" class="quantity">1</span>
                                <button data-item-id="${itemId}" data-price="${itemPrice}" class="quantity-btn">+</button>
                            </div>
                        </div>
                        <div class="item-total"><span>₹</span>
                            <div data-item-id="${itemId}" class="total-price">${itemPrice}</div>
                        </div>
                        <button data-item-id="${itemId}" data-cart-id="${data.cartId}" class="remove-btn" onclick="removeItem(this)">×</button>
                    </div>
                `;

                            const tempDiv = document.createElement("div");
                            tempDiv.innerHTML = cartHTML.trim();
                            const newCartItem = tempDiv.firstChild;

                            cartItems.insertBefore(newCartItem, cartSummary);


                            updateAddButton();
                            updateTotalPrice();

                        } else {
                            console.log("Failed to add item to cart.");
                        }
                    });
            }
        });

    }

    function cartUpdateQuantity() {
        const cartItems = document.getElementById("cart-items");

        cartItems.addEventListener("click", function(event) {
            if (event.target.classList.contains("quantity-btn")) {
                event.preventDefault();

                const button = event.target;
                const itemId = button.dataset.itemId;
                const sign = button.textContent.trim();
                const price = parseInt(button.dataset.price);

                const el = document.querySelector(`.quantity[data-item-id="${itemId}"]`);
                const totalPrice = document.querySelector(`.total-price[data-item-id="${itemId}"]`);
                let count = parseInt(el.textContent.trim());

                let url = ROOT+"api/update_quantity";

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
                            updateTotalPrice();
                        }
                    });

                console.log("you pressed " + itemId + ": sign:" + sign);
            }
        });
    }


    function removeItem(button) {
        event.preventDefault();
        const cartId = button.dataset.cartId;
        const itemId = button.dataset.itemId; // ✅ Add this line
        const url = ROOT+"api/removeFromCart";

        fetch(url, {
                method: "POST",
                headers: {
                    'Content-Type': "application/json"
                },
                body: JSON.stringify({
                    cart_id: cartId
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    const parent = button.closest('.cart-item');
                    parent.remove();

                    updateAddButton();
                    updateTotalPrice();


                }
            });
    }


    function updateAddButton() {
        const menuItems = document.querySelectorAll(".menu-item");

        menuItems.forEach(item => {
            const itemId = item.dataset.itemId;
            let url = ROOT+"api/updateAddButton";
            fetch(url, {
                    method: "POST",
                    headers: {
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify({
                        item_id: itemId
                    })
                })
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    let con = item.querySelector('.item-footer');
                    const existBtn = con.querySelector("button");
                    if (existBtn) {
                        con.removeChild(existBtn);
                    }
                    let button = document.createElement("button");
                    button.classList.add('Add-Btn');
                    if (data.success) {


                        button.classList.add("addCart-btn-success");
                        button.textContent = "Added to Cart"


                    } else {


                        button.classList.add("addCart-btn");
                        button.textContent = "Add To Cart";
                    }
                    con.appendChild(button);
                })

        })

    }

    function updateTotalPrice() {
        let url = ROOT+"api/TotalItemsPrice";

        fetch(url)
            .then(res => res.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    const total = parseInt(data.total);
                    const el = document.getElementById('full-total-price');
                    el.textContent = total;
                }
            })
    }