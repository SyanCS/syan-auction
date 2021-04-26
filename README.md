# syan-auction
scopic test

1 - Navigate to frontend and run npm install
2 - Navigate to backend and run composer install
3 - User the file dump.zip to populate yout syan_auction database
4 - Set the following command in your crontab so the end date of the auctions work: "*/2 * * * * cd /full/path/to/backend/ &&  bin/cake end_auctions"
5 - Navigate to frontend and run npm run serve
7 - Navigate to backend/config/ and use the app_local.example.php to setup your app_local.php configuring the Datasources with your database credentials
8 - Navigate to backend and run bin/cake server

CREDENTIALS:

admin/2ET0Qb
user1/2ET0Qb
user2/2ET0Qb