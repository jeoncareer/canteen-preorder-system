// Entry point: initialize cart/menu functionality on page load
updateAddButton();
cartUpdateQuantity();
addToCart();

// Handles adding items to the cart when the 'Add To Cart' button is clicked
function addToCart() {
    // Use event delegation to handle clicks on dynamically created buttons
    document.addEventListener("click", function(event) {
        if (event.target.classList.contains("addCart-btn")) {
            const button = event.target;
            // Get item details from the closest menu-item element
            const itemId = button.closest(".menu-item").dataset.itemId;
            const itemName = button.closest(".menu-item").querySelector(".item-name").textContent;
            const itemPrice = button.closest(".menu-item").querySelector(".item-price").textContent.replace(/[^\d]/g, '');

            const url = ROOT + 'api/addToCart';

            // Send a POST request to add the item to the cart
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
                        // Update the cart UI with the new item
                        const cartItems = document.getElementById("cart-items");
                        const cartSummary = document.getElementById("cart-summary");

                        // Build the cart item HTML
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

                        // Insert the new cart item into the DOM
                        const tempDiv = document.createElement("div");
                        tempDiv.innerHTML = cartHTML.trim();
                        const newCartItem = tempDiv.firstChild;

                        cartItems.insertBefore(newCartItem, cartSummary);

                        // Update UI state
                        updateAddButton();
                        updateTotalPrice();

                    } else {
                        console.log("Failed to add item to cart.");
                    }
                });
        }
    });
}

// Handles updating the quantity of items in the cart
function cartUpdateQuantity() {
    const cartItems = document.getElementById("cart-items");

    // Listen for clicks on quantity buttons inside the cart
    cartItems.addEventListener("click", function(event) {
        if (event.target.classList.contains("quantity-btn")) {
            event.preventDefault();

            const button = event.target;
            const itemId = button.dataset.itemId;
            const sign = button.textContent.trim(); // '+' or '−'
            const price = parseInt(button.dataset.price);

            // Find the quantity and total price elements for this item
            const el = document.querySelector(`.quantity[data-item-id="${itemId}"]`);
            const totalPrice = document.querySelector(`.total-price[data-item-id="${itemId}"]`);
            let count = parseInt(el.textContent.trim());

            let url = ROOT+"api/update_quantity";

            // Send a POST request to update the quantity
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
                        // Update the quantity and total price in the UI
                        el.textContent = data.count;
                        totalPrice.textContent = data.count * price;
                        updateTotalPrice();
                    }
                });

            console.log("you pressed " + itemId + ": sign:" + sign);
        }
    });
}

// Handles removing an item from the cart
function removeItem(button) {
    event.preventDefault(); // Note: event is not passed in, could cause issues
    const cartId = button.dataset.cartId;
    const itemId = button.dataset.itemId; // ✅ Add this line
    const url = ROOT+"api/removeFromCart";

    // Send a POST request to remove the item from the cart
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
            console.log('from',data);
            if (data.success) {
                // Remove the item from the DOM
                const parent = button.closest('.cart-item');
                parent.remove();

                updateAddButton();
                updateTotalPrice();
            }
        });
}

// Updates the "Add to Cart" button state for each menu item
function updateAddButton() {
    const menuItems = document.querySelectorAll(".menu-item");

    menuItems.forEach(item => {
        const itemId = item.dataset.itemId;
        let url = ROOT+"api/updateAddButton";
        // Check if the item is already in the cart
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
                console.log('from',data);
                let con = item.querySelector('.item-footer');
                const existBtn = con.querySelector("button");
                if (existBtn) {
                    con.removeChild(existBtn);
                }
                let button = document.createElement("button");
                button.classList.add('Add-Btn');
                if (data.success) {
                    // If already in cart, show "Added to Cart" state
                    button.classList.add("addCart-btn-success");
                    button.textContent = "Added to Cart"
                } else {
                    // Otherwise, show "Add To Cart" button
                    button.classList.add("addCart-btn");
                    button.textContent = "Add To Cart";
                }
                con.appendChild(button);
            })
    })
}

// Updates the total price displayed in the cart
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


  function ucWords(word)
                {
                    return word.charAt(0).toUpperCase()+word.slice(1);
                }