#On this page you will find sample code for the IBM Hackathon at ZendCon 2014. 

To get a copy of this code, use your favorite git client to perform

```
git clone https://github.com/IBM-Bluemix/zendcon-2014-hackathon.git
```

or click on the Download Zip button on the right side of this page.

The top level directory contains subdirectories for various services you may find useful as you are hacking your code. Remember, you are free to use any service you would like but we encourage you to consider the services listed below.

Before starting with any of the following instructions, ensure that you have IBM Bluemix account. You can register for one here: https://apps.admin.ibmcloud.com/manage/trial/bluemix.html

Also, download and install a Cloud Foundry command line interface which you will use to deploy to Bluemix. The steps to download the tool are described here: https://www.ng.bluemix.net/docs/#cli/index.html#cli

##Cloudant Document-Oriented (NoSQL) Database

Cloudant is a JSON data store, a type of a NoSQL database that is an excellent fit for multi-structured data, unstructured data and fast-changing data models.

To try the sample Cloudant application, change directory to ```cloudant``` and then modify the manifest.yml file to replace the following string ```<REPLACEME>``` with a unique value, e.g. a random number. Next execute the following, using the same unique value instead of the  ```<REPLACEME>``` string below.


```
cf login
cf push
cf create-service cloudantNoSQLDB Shared myCloudant
cf bind-service cloudant-php-<REPLACEME> myCloudant
cf push
```
Once the ```cf push``` operation completes successfully, the sample application will be accessible with your favorite browser from ```http://cloudant-php-<REPLACEME>.mybluemix.net```


##MySQL Relational Database

PHP developer's default choice for a relational database, MySQL needs no introduction. With Bluemix, you can easily get a MySQL database with up to 10MB storage and up to 10 connections. 

To try the sample MySQL application, change directory to ```mysql``` and then modify the manifest.yml file to replace the following string ```<REPLACEME>``` with a unique value, e.g. a random number. Next execute the following, using the same unique value instead of the  ```<REPLACEME>``` string below.

```
cf login
cf push
cf create-service mysql 100 mySql
cf bind-service mysql-php-<REPLACEME> mySql
cf push
```
Once the ```cf push``` operation completes successfully, the sample application will be accessible with your favorite browser from ```http://mysql-php-<REPLACEME>.mybluemix.net```


##Sendgrid

Sendgrid is the world's largest email infrastructure as a service provider focused on deliverability, scalability, and reliability. 

To try the sample Sendgrid application, change directory to ```sendgrid``` and then modify the manifest.yml file to replace the following string ```<REPLACEME>``` with a unique value, e.g. a random number. Next execute the following, using the same unique value instead of the  ```<REPLACEME>``` string below.


```
cf login
cf push
cf create-service sendgrid free mySendgrid
cf bind-service sendgrid-php-<REPLACEME> mySendgrid
cf push
```
Once the ```cf push``` operation completes successfully, the sample application will be accessible with your favorite browser from ```http://sendgrid-php-<REPLACEME>.mybluemix.net```

##Twilio

Twilio enables phones, VoIP, and messaging to be embedded into web, desktop, and mobile software. To try the Twilio on Bluemix, you will need to register for a Twilio account (unless you already have one) using the following link https://www.twilio.com/try-twilio?promo=bluemix

You will also need a number that can receive text messages. This number must be verified with Twilio using the following link twilio.com/user/account/phone-numbers/verified

When you are registered with Twilio and ready to try the sample Twilio application, change directory to ```twilio``` and then modify the manifest.yml file to replace the following string ```<REPLACEME>``` with a unique value, e.g. a random number.

Next execute the following commands from your console, using the same unique value instead of the  ```<REPLACEME>``` string below.

```
cf login
cf push
```

Twilio service must be bound to your application using the Bluemix UI. Login to Bluemix and using the Dashboard menu item, navigate to your application. Click on your application, click Add a service and choose Twilio from the catalog. On the right side bar, specify ```Twilio``` as the service name and enter the Twilio SID and token values as available from your Twilio dashboard.

A more detailed example of binding Twilio service to your application is available from https://www.twilio.com/blog/2014/02/twilio-and-ibm-codename-bluemix-nt.html

Next execute the following commands from your console, using your Twilio assigned phone number instead of the  ```<TWILIO_NUMBER>``` string and using a number where you want to send a text instead of ```<TEXT_NUMBER>```.

```
cf set-env twilio-php-<REPLACEME> MY_TWILIO_NUMBER <TWILIO_NUMBER>
cf set-env twilio-php-<REPLACEME> MY_DESTINATION_NUMBER <TEXT_NUMBER>
curl http://twilio-php-<REPLACEME>.mybluemix.net
```
