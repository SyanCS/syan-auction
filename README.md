## Installation
1.  Navigate to frontend and run npm install.
2.  Navigate to backend and run composer install.
3.  User the file Dump.sql to populate yout syan_auction database.
4.  Set the following command in your crontab so the end date of the auctions work: "*/2 * * * * cd /full/path/to/backend/ &&  bin/cake end_auctions".
5.  Navigate to frontend and run npm run serve.
7.  Navigate to backend/config/ and use the app_local.example.php to setup your app_local.php configuring the Datasources with your database credentials.
8.  Navigate to backend and run bin/cake server.

## Credentials:

1. admin/2ET0Qb
2. user1/2ET0Qb
4. user2/2ET0Qb