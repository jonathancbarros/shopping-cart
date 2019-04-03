Shopping Cart
================

## Setting the environment up!

As the idea was to create a very basic API, I used Laravel 5.8 with PHP >=7.1 and SQLite.

```
You will need to run the composer update to get everything up running, and also create a .env file based on .env.example,
inside of it, you will need to insert the credencials for the SQLite database as follows:

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

In order to get the database running, you need to create it by running - touch database/database.sqlite - and then 
you will have a SQLite file in database/database.sqlite.

Maybe you need to setup the absolute path of the database in config/database.php as recommended by the Laravel docs.
```

After this, you just need to run the migrations and the seed in order to have a basic set of products, as follows:

php artisan migrate
php artisan db:seed

##### Products:

id | name | value
-- | -- |--
1	| iPhone XR	| 5000
2	| Samsung 40" 4K | 3000
3	| Nike Air	|500

If you didn't have any problem so far and the migrations ran successfully, you are good to start the server by running:

**php artisan serve**

Now you are good to go, use the URL **http://127.0.0.1:8000** to access the endpoints.

## API Documentation

### POST /shopping_carts

### Body

```
{
	"product_id" : 3,
	"amount" : 10
}
```

#### Returns

```
200 OK
Content-Type: "application/json"

{
    "success": true,
    "data": {
        "product_id": 3,
        "amount": 10,
        "updated_at": "2019-04-03 19:03:58",
        "created_at": "2019-04-03 19:03:58",
        "id": 6
    },
    "message": "Product added successfully"
}
```
##### Errors:

Error | Description
----- | ------------
400   | Error of Validation or the product already exists in the shopping cart
404   | The product does not exist 

### GET /shopping_cart

##### Returns:
```

200 OK
Content-Type: "application/json"

{
    "success": true,
    "data": {
        "total": 80000,
        "items": [
            "Samsung 40\" 4K",
            "Nike Air"
        ]
    },
    "message": "The shopping cart has been returned successfully"
}
```

### PUT /shopping_cart/{id}/{amount}

Attribute | Description
----------| -----------
id    | Product ID
amount | Amount of items

##### Returns:

```
200 OK
Content-Type: "application/json"

{
    "success": true,
    "data": {
        "id": 5,
        "product_id": "2",
        "amount": "25",
        "created_at": "2019-04-03 18:43:47",
        "updated_at": "2019-04-03 19:03:43"
    },
    "message": "Shopping Cart Updated Successfully"
}
```

##### Errors:

Error | Description
----- | ------------
404   | The Shopping Cart does not have this product or the product does not exist

### DELETE /shopping_cart/{id}

Attribute | Description
----------| -----------
id    | Product ID

##### Returns:

```
204 No Content
