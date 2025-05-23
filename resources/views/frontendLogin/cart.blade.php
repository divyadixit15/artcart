<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>ArtCart - Cart</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            min-height: 100vh;
            padding-top: 60px; /* space for fixed navbar */
            color: #2c3e50;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: #34495e;
            color: white;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .navbar .title {
            font-size: 22px;
            font-weight: bold;
        }

        .navbar .menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar .menu a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            padding: 8px 14px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navbar .menu a:hover {
            background-color: #2c3e50;
        }

        main {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
            font-weight: 700;
            color: #34495e;
            text-align: center;
        }

        #cart-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .cart-item {
            background: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .cart-item h3 {
            font-size: 18px;
            color: #34495e;
            margin-bottom: 8px;
            flex-basis: 100%;
        }

        .cart-item-details {
            font-size: 16px;
            color: #555;
            margin-right: 20px;
            min-width: 120px;
        }

        .cart-item-actions {
            display: flex;
            gap: 10px;
        }

        button {
            padding: 8px 14px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        .remove-button {
            background-color: #dc3545;
        }

        .remove-button:hover {
            background-color: #b52a37;
        }

        #total-container {
            font-weight: bold;
            font-size: 1.3rem;
            margin-top: 25px;
            text-align: right;
            color: #27ae60;
        }

        #pay-button {
            margin-top: 20px;
            background-color: #0a74da;
            width: 160px;
            display: block;
            margin-left: auto;
            font-size: 16px;
        }

        #pay-button:hover {
            background-color: #085cbf;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .cart-item-actions {
                margin-top: 10px;
            }

            #total-container {
                text-align: left;
            }

            #pay-button {
                width: 100%;
            }
        }
    </style>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

    <div class="navbar">
        <div class="title">ArtCart</div>
        <div class="menu">
            <a href="/frontend/cart">Cart</a>
        </div>
    </div>

    <main>
        <h1>Your Cart</h1>
        <div id="cart-container">Loading your cart...</div>
        <div id="total-container"></div>
        <button id="pay-button" style="display:none;">Pay Now</button>
    </main>

    <script>
        let totalAmount = 0;
        let cartItemsArray = [];

        async function getCart() {
            const response = await fetch('/api/cart', {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            const cartContainer = document.getElementById('cart-container');
            const totalContainer = document.getElementById('total-container');
            const payButton = document.getElementById('pay-button');

            cartContainer.innerHTML = '';
            totalContainer.innerHTML = '';
            payButton.style.display = 'none';

            if (response.ok && data.cartItems.length > 0) {
                cartItemsArray = data.cartItems;

                data.cartItems.forEach(item => {
                    const div = document.createElement('div');
                    div.classList.add('cart-item');

                    div.innerHTML = `
                        <h3>${item.product.name}</h3>
                        <div class="cart-item-details">Quantity: ${item.quantity}</div>
                        <div class="cart-item-actions">
                            <button onclick="updateItem(${item.id})">Update Quantity</button>
                            <button class="remove-button" onclick="removeItem(${item.id})">Remove</button>
                        </div>
                    `;

                    cartContainer.appendChild(div);
                });

                totalAmount = parseFloat(data.total) * 100; // paise
                totalContainer.innerText = `Total: $${parseFloat(data.total).toFixed(2)}`;
                payButton.style.display = 'inline-block';
            } else {
                cartContainer.innerHTML = "<p>Your cart is empty.</p>";
                cartItemsArray = [];
            }
        }

        async function updateItem(itemId) {
            const newQuantity = prompt("Enter new quantity:", "1");
            const qty = parseInt(newQuantity);
            if (qty && qty > 0) {
                const res = await fetch(`/api/cart/item/${itemId}`, {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ quantity: qty })
                });
                if (res.ok) {
                    alert("Cart item updated!");
                    getCart();
                } else {
                    alert("Failed to update cart item.");
                }
            } else {
                alert("Please enter a valid quantity (1 or more).");
            }
        }

        async function removeItem(itemId) {
            const res = await fetch(`/api/cart/item/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                }
            });
            if (res.ok) {
                alert("Item removed from cart!");
                getCart();
            } else {
                alert("Failed to remove item.");
            }
        }

        document.getElementById('pay-button').addEventListener('click', async () => {
            const orderRes = await fetch('/api/cart/create-order', {
                headers: {
                    'Accept': 'application/json',
                }
            });
            const orderData = await orderRes.json();

            if (!orderRes.ok) {
                alert(orderData.message || 'Could not create order');
                return;
            }

            const options = {
                key: orderData.key,
                amount: orderData.amount,
                currency: orderData.currency,
                name: 'ArtCart',
                description: 'Purchase',
                order_id: orderData.orderId,
                handler: async function (response) {
                    const paymentRes = await fetch('/api/cart/payment', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            payment_id: response.razorpay_payment_id,
                            order_id: response.razorpay_order_id,
                            signature: response.razorpay_signature,
                            total_amount: orderData.amount,
                            cart_items: cartItemsArray.map(item => ({
                                product_id: item.product.id,
                                quantity: item.quantity,
                                price: item.product.price
                            }))
                        }),
                    });

                    if (paymentRes.ok) {
                        alert('Payment successful!');
                        window.location.href = '/frontend/products';
                    } else {
                        alert('Payment verification failed.');
                    }
                },
                prefill: {
                    name: '',
                    email: '',
                    contact: '',
                },
                theme: {
                    color: '#28a745',
                },
            };

            const rzp = new Razorpay(options);
            rzp.open();
        });

        getCart();
    </script>
</body>
</html>
