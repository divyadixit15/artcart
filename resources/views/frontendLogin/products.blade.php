<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>ArtCart</title>
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
        font-size: 20px;
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
        padding: 8px 12px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .navbar .menu a:hover {
        background-color: #2c3e50;
    }

    main {
        margin-top: 60px; /* Since navbar fixed height */
        padding: 20px;
        min-height: 100vh;
    }

    h1 {
        margin-bottom: 20px;
        color: #2c3e50;
    }

    #products-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .product-card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        width: calc(25% - 20px);
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: box-shadow 0.3s ease;
    }

    .product-card:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }

    .product-images img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .product-card h3 {
        font-size: 18px;
        margin-bottom: 8px;
        color: #34495e;
    }

    .product-card p {
        flex-grow: 1;
        font-size: 14px;
        color: #555;
        margin-bottom: 8px;
    }

    .product-card p strong {
        color: #27ae60;
        font-size: 16px;
    }

    label {
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 4px;
        display: block;
        color: #2c3e50;
    }

    input[type="number"] {
        width: 60px;
        padding: 6px 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
        margin-bottom: 10px;
        font-size: 14px;
    }

    button {
        padding: 10px 0;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #218838;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .product-card {
            width: calc(33.333% - 20px); 
        }
    }

    @media (max-width: 768px) {
        .product-card {
            width: calc(50% - 20px); 
        }
    }

    @media (max-width: 480px) {
        main {
            padding-left: 10px;
            padding-right: 10px;
        }
        .product-card {
            width: 100%; 
        }
    }
</style>
</head>
<body>

    <div class="navbar">
        <div class="title">ArtCart</div>
        <div class="menu">
            <a href="/frontend/cart">Cart</a>
        </div>
    </div>

    <main>
        <h1>Our Products</h1>
        <div id="products-container">Loading products...</div>
    </main>

    <script>
        async function getProducts() {
            const response = await fetch('/api/products', {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const productsContainer = document.getElementById('products-container');
            productsContainer.innerHTML = '';

            if (response.ok) {
                const data = await response.json();

                data.forEach(product => {
                    const productCard = document.createElement('div');
                    productCard.classList.add('product-card');

                    let imagesHtml = '';
                    if (product.images.length > 0) {
                        imagesHtml = `<img src="${product.images[0].image_url}" alt="Product Image">`;
                    }

                    productCard.innerHTML = `
                        <div class="product-images">${imagesHtml}</div>
                        <h3>${product.name}</h3>
                        <p>${product.description || ''}</p>
                        <p><strong>$${product.price}</strong></p>
                        <label for="qty-${product.id}">Quantity:</label>
                        <input type="number" id="qty-${product.id}" min="1" value="1" />
                        <button onclick="addToCart(${product.id})">Add to Cart</button>
                    `;
                    productsContainer.appendChild(productCard);
                });
            } else {
                productsContainer.innerHTML = "Error loading products.";
            }
        }

        async function addToCart(productId) {
            const qtyInput = document.getElementById(`qty-${productId}`);
            let quantity = parseInt(qtyInput.value);

            if (!quantity || quantity < 1) {
                alert("Please enter a valid quantity (1 or more).");
                return;
            }

            const response = await fetch('/api/cart/add', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            });

            const data = await response.json();

            if (response.ok) {
                alert("Product added to cart!");
                window.location.href = '/frontend/cart';
            } else {
                console.error('Add to cart failed:', data);
                alert(data.message || "Failed to add product to cart.");
            }
        }

        getProducts();
    </script>
</body>
</html>
