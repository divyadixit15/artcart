# ArtCart - Home Decor E-Commerce Backend

**ArtCart** is a Laravel-based e-commerce backend system where users can browse and order home decor products with multiple images. It features a CMS admin panel for product and cart management, along with a RESTful API for frontend integration.

---

## Project Features

### PHASE 1 – Product Management & API Integration

- Relational MySQL database schema.
- Backend built with **Laravel** (PHP > 8).
- Products include: `name`, `price`, and **multiple images**.
- Full **CRUD** functionality for products.
- Admin panel to:
  - Add, edit, delete products.
  - Upload and manage multiple images per product.
- **GET API** to fetch all products with images.

### PHASE 2 – Cart Functionality & API

- **POST API** to add products to the cart (Hardcoded `user_id = 1`).
- Admin panel view to list cart items.
- **GET API** for viewing cart list by admin.
- Cart items show:
  - Product details
  - Cart total
  - Quantity
- API for:
  - Add to cart
  - Update cart items
  - Delete cart items
  - Checkout with **payment gateway integration** (e.g., Stripe or Razorpay)

---

## Tech Stack

- **Backend**: Laravel 12+
- **Database**: MySQL 8+
- **Admin UI**: Integrated with a clean and modern admin template (Bootstrap based)
- **Authentication**: Admin login using Laravel auth 
- **File Uploads**: Laravel Filesystem
- **Payment Gateway**: Razorpay

---

## Project Structure

app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/
│   │   |   ├──CartApiController.php
│   │   |   ├── ProductApiController.php
│   │   ├── Auth/
│   │   |   ├──LoginController.php
│   │   ├── ProductController.php
│   │   ├── OrderController.php
├── Models/
│   ├── Product.php
│   ├── ProductImage.php
│   ├── Cart.php
│   ├── CartItem.php
│   ├── Order.php
│   ├── OrderItem.php
resources/
├── views/
│   │   ├── auth/
│   │   |   ├──login.blade.php
│   │   ├── frontendLogin/
│   │   |   ├──cart.blade.php
│   │   |   ├──login.blade.php
│   │   |   ├──products.blade.php
│   │   ├── layouts/
│   │   |   ├──sidebar.blade.php
│   │   |   ├──navbar.blade.php
│   │   |   ├──products.blade.php
│   │   ├── orders/
│   │   |   ├──index.blade.php
│   │   |   ├──show.blade.php
│   │   ├── products/
│   │   |   ├──create.blade.php
│   │   |   ├──edit.blade.php
│   │   |   ├──index.blade.php
│   │   |   ├──show.blade.php
│   │   |   ├──upload_images.blade.php
│   ├── dashboard.blade.php/

routes/
├── api.php
├── web.php

```bash
git clone https://github.com/divyadixit15/artcart.git
cd artcart_project

## Install dependencies

 -- **composer install**
Create .env and configure

cp .env.example .env
php artisan key:generate

## Set database credentials in .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=artcart_project
DB_USERNAME=root
DB_PASSWORD=

##  API Documentation
 Products API
Method	     Endpoint	               Description
GET	        /api/products       	List all products with images
POST    	/api/products	        Create a new product
GET	        /api/products/{id}	    Get a single product detail
PUT      	/api/products/{id}     	Update a product
DELETE  	/api/products/{id}	    Delete a product

 Cart API
Method	     Endpoint	               Description
POST     	/api/cart/add	      Add product to cart (user_id = 1)
PUT     	/api/cart/item/{id}	  Update quantity or info of a cart item
DELETE   	/api/cart/item/{id}	  Remove an item from the cart
GET	        /api/cart	          View all cart items

 Order & Payment API
Method	        Endpoint	              Description
GET	        /api/cart/create-order	   Generate order before payment
POST    	/api/cart/payment	       Process and store payment data

** Frontend Redirect **
Method	Endpoint	Description
POST	/frontend/products	Redirects to /frontend/products

Postman Collection : ArtCart_Postman_Collection.postman_collection.json

sql backup : databases/artcart_db_backup.sql
