Cloudant

```
cf login
cf push
cf create-service cloudantNoSQLDB Shared myCloudant
cf bind-service cloudant-php-12345 myCloudant
cf push
```

Sendgrid

```
cf login
cf push
cf create-service sendgrid free mySendgrid
cf bind-service sendgrid-php-12345 mySendgrid
cf push
```
