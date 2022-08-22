# Cognito users app
This app will validate if the user is authenticated in order to show their gallery that come from aws s3 bucket.

We will use th **Enhanced authflow** with developer provider to authenticate the user. [AWS auth methods](https://docs.aws.amazon.com/cognito/latest/developerguide/authentication-flow.html)

![Cognito Enhanced authflow](https://docs.aws.amazon.com/cognito/latest/developerguide/images/amazon-cognito-dev-auth-enhanced-flow.png)

- Login via Developer Provider (code outside of Amazon Cognito)

- Validate the user login (code outside of Amazon Cognito)

- GetOpenIdTokenForDeveloperIdentity

- GetCredentialsForIdentity


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