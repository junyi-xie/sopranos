# Soparanos Pizzaria - ALA P7

I will be creating an online webshop where you can buy multiple/different types of pizzas. The shop backend will be written in **Object-Oriented PHP** and **MySQL**, as for the frontend, it will be done with **HTML/CSS**, and some **JavaScript** as well.

## Folder Structure ##

```
📦sopranos
 ┣ 📂assets
 ┃ ┣ 📂css
 ┃ ┃ ┣ 📜style.css
 ┃ ┃ ┣ 📜style.css.map
 ┃ ┃ ┣ 📜style.scss
 ┃ ┃ ┣ 📜_footer.scss
 ┃ ┃ ┣ 📜_general.scss
 ┃ ┃ ┣ 📜_header.scss
 ┃ ┃ ┗ 📜_reset.scss
 ┃ ┣ 📂fonts
 ┃ ┣ 📂images
 ┃ ┃ ┣ 📂favicon
 ┃ ┃ ┃ ┗ 📜favicon.ico
 ┃ ┃ ┗ 📂layout
 ┃ ┗ 📂js
 ┃ ┃ ┗ 📜index.js
 ┣ 📂inc
 ┃ ┣ 📜class.php
 ┃ ┣ 📜connect.php
 ┃ ┗ 📜functions.php
 ┣ 📜about.php
 ┣ 📜index.php
 ┗ 📜README.md
```

## Requirements ##
- Able to order online
- Able to checkout online
- Able to view the products
- Able to see their order
- Able to receive an invoice/confirmation mail

## Login to Admin Panel ##
Although  not _required_, I will include an admin panel, which can be used to view your orders, edit products, and more. 

**Note:** to add an admin account, you will have to manually insert/create a new account into the database.

```php
$pdo->exec("INSERT INTO accounts SET id = NULL, username = 'admin', password = password_hash('admin', PASSWORD_DEFAULT), email = 'admin@admin.com', phone = '123456789', admin = 1, account_created = date("YmdHis"), last_login = 0");
```

Now that you have inserted a new account, you can simply login to the admin panel with admin/admin.

## Database ## 
📃 [sopranos.sql](https://github.com/junyi-xie/sopranos/blob/main/sopranos.sql), feel free to import it into MySQL.

**Note:** Be sure to change the database name to match your own, you can configurate the database settings [here!](https://github.com/junyi-xie/sopranos/blob/main/inc/connect.php)
