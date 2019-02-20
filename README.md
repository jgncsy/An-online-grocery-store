# An-online-grocery-store
This project is to design and implement an online grocery store. PHP will be used to build the basic framework of web pages and MySQL will be used for creating database in the back-end. The database stores all the information regarding.
1.	There are three roles available: Visitor, Customer and Admin. A visitor is allowed to browse the catalog of all available products. A customer is a person who has already registered. A customer is allowed to browse and purchase the available products. An admin has some extra privilege including all privilege of a visitor and a customer, such as: 
(1) add/edit/remove products; 
(2) add/edit/remove users;
(3) be given the access to a password protected webpage that displays the information of some statistical report about: (a) the aggregate sales and profit of the products, (b) the top 3 best sellers so far, (c) the sales volume comparison for a given product in different regions, (d) which business are buying given products the most.
2.	Register and Login function will be created for the system. The user name, password, mailing address, billing address and email address are required to complete the registration, and then all the information will be stored in the database for this customer. For logging in, the customer is required to type in the matching user name and password otherwise the system will pop up an error message “The user name or password does not match”.
3.	Shopping cart function will be created for the system. When purchasing, the customer selects the products of interest and adds them to the shopping cart. The customer is able to edit the shopping cart by removing the item, editing the quantity, and going back the product catalog.
4.	After reviewing the shopping cart, the customer clicks the “Check Out” button, and a new order with a unique order ID will be created in the database. The customer will be redirected to a new page asking for the recipient’s name, mailing address, name on the credit card, and credit card information. Upon clicking the “Submit” button, the payment information will be saved in the database, and a salesperson (determined by the closest Zip code) who is in charge of packaging and shipping will be assigned to this order. At the same time, the customer will be redirected to a new page that lists the order details including the products purchased, salesperson name and store.