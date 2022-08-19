# Cognito users app
This app will validate if the user is authenticated in order to show their gallery that come from aws s3 bucket.

## Development
First we need to install the dependencies:
```bash
composer install
```

Then we need to create the database:
```bash
php spark db:create cognito_users
```

Then we need to migrate the database:
```bash
php spark migrate
```

Then we need to seed the database:
```bash
php spark db:seed UserSeeder
```