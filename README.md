#On this page you will find sample code for the IBM Hackathon at ZendCon 2014. 

To get a copy of this code, use your favorite git client to perform

```
git clone https://github.com/IBM-Bluemix/zendcon-2014-hackathon.git
```

or click on the Download Zip button on the right side of this page.

Before starting with any of the following instructions, ensure that you have IBM Bluemix account. You can register for one here: https://apps.admin.ibmcloud.com/manage/trial/bluemix.html

Also, download and install a Cloud Foundry command line interface which you will use to deploy to Bluemix. The steps to download the tool are described here: https://www.ng.bluemix.net/docs/#cli/index.html#cli

The top level directory of this project contains subdirectories for various services you may find useful as you are hacking your code. Remember, you are free to use any service you would like but we encourage you to consider the services listed below.

* [Cloudant Document-oriented NoSQL Database](
https://github.com/IBM-Bluemix/zendcon-2014-hackathon/blob/master/README.md#cloudant-document-oriented-nosql-database)
* [MySQL Relational Database](https://github.com/IBM-Bluemix/zendcon-2014-hackathon#mysql-relational-database)
* [Sendgrid Email as a Service](https://github.com/IBM-Bluemix/zendcon-2014-hackathon#sendgrid-email-as-a-service)
* [Twilio Telephony as a Service](https://github.com/IBM-Bluemix/zendcon-2014-hackathon#twilio-telephony-as-a-service)
* [Internet of Things / Wearables](https://github.com/IBM-Bluemix/zendcon-2014-hackathon#internet-of-things--wearables)
* [IBM Watson Question Answering for Travel](https://github.com/IBM-Bluemix/zendcon-2014-hackathon#ibm-watson-question-answering-qa-for-travel)

All of the sample code is preconfigured to deploy a PHP 5.4 compatible application to Zend Server 7.0 Enterprise running on IBM Bluemix. If you want to modify this environment (e.g. to turn on Z-Ray), check out the buildpack instructions available here: https://github.com/zendtech/zend-server-php-buildpack-bluemix

##Cloudant Document-Oriented (NoSQL) Database

Cloudant is a JSON data store, a type of a NoSQL database that is an excellent fit for multi-structured data, unstructured data and fast-changing data models.

To try the sample Cloudant application, change directory to ```cloudant``` and and then deploy to Bluemix by executing the following commands:

```
cf login
cf create-service cloudantNoSQLDB Shared myCloudant
cf push
```

After the commands complete successfully, look for the console output specifying the application URL. It should look something like 

```
usage: 256M x 1 instances
urls: cloudant-random-word.mybluemix.net
```

Open your favorite browser using the URL ending with mybluemix.net (such as cloudant-random-word.mybluemix.net in the example above) from the console output to access the application. 

##MySQL Relational Database

PHP developer's default choice for a relational database, MySQL needs no introduction. With Bluemix, you can easily get a MySQL database with up to 10MB storage and up to 10 connections. 

To try the sample MySQL application, change directory to ```mysql``` and then deploy to Bluemix by executing the following commands:

```
cf login
cf create-service mysql 100 mySql
cf push
```

After the commands complete successfully, look for the console output specifying the application URL. It should look something like: 

```
usage: 256M x 1 instances
urls: mysql-random-word.mybluemix.net
```

Open your favorite browser using the URL ending with mybluemix.net (such as mysql-random-word.mybluemix.net in the example above) from the console output to access the application. 

##Sendgrid Email as a Service

Sendgrid is the world's largest email infrastructure as a service provider focused on deliverability, scalability, and reliability. 

To try the sample Sendgrid application, change directory to ```sendgrid``` and then deploy to Bluemix by executing the following commands:

```
cf login
cf create-service sendgrid free mySendgrid
cf push
```

After the commands complete successfully, look for the console output specifying the application URL. It should look something like: 

```
usage: 256M x 1 instances
urls: sendgrid-random-word.mybluemix.net
```

Next execute the following commands from your console, to specify custom to/from email addresses using Bluemix environment variables. 

```
cf set-env sendgrid TO_EMAIL bluemix@mailinator.com
cf set-env sendgrid FROM_EMAIL foo@bar.com
cf restage sendgrid
```

Open your favorite browser using the URL ending with mybluemix.net (such as sendgrid-random-word.mybluemix.net in the example above) from the console output to access the application. 

##Twilio Telephony as a Service

Twilio enables phones, VoIP, and messaging to be embedded into web, desktop, and mobile software. To try the Twilio on Bluemix, you will first need to register for a Twilio account (unless you already have one) using the following link https://www.twilio.com/try-twilio?promo=bluemix

You will also need a number that can receive text messages. This number must be verified with Twilio using the following link http://twilio.com/user/account/phone-numbers/verified

Once you are registered with Twilio and ready to try the sample Twilio application, change directory to ```twilio```  and execute the following commands from your console.

```
cf login https://api.ng.bluemix.net
cf push
```

After the command completes successfully, look for the console output specifying the application URL. It should look something like 

```
usage: 256M x 1 instances
urls: twilio-random-word.mybluemix.net
```

Take note of the URL ending with mybluemix.net (such as twilio-random-word.mybluemix.net in the example above) from the console output. You will need it later to access the application.

Twilio service must be bound to your application using the Bluemix UI. Login to Bluemix and using the Dashboard menu item, navigate to your application. Click on your application, click Add a service and choose Twilio from the catalog. On the right side bar, specify ```Twilio``` as the service name and enter the Twilio SID and token values as available from your Twilio dashboard.

A more detailed example of binding Twilio service to your application is available from https://twilio.com/blog/2014/02/twilio-and-ibm-codename-bluemix-nt.html

Next execute the following commands from your console, using your Twilio assigned phone number instead of the  ```<TWILIO_NUMBER>``` string and using a number where you want to send a text instead of ```<TEXT_NUMBER>```.

```
cf set-env twilio MY_TWILIO_NUMBER <TWILIO_NUMBER>
cf set-env twilio MY_DESTINATION_NUMBER <TEXT_NUMBER>
cf restage twilio
```

To test the application, open your favorite browser using the application URL you noted earlier, i.e the one ending with mybluemix.net.

##Internet of Things / Wearables

IBM built an Internet of Things (IoT) demo that collects heart rate data from users of a Mio Heart Rate Monitor ( http://www.heartratemonitorsusa.com/mio-alpha.html ), adds GPS-based location information from an iPhone, and persists the result in a Cloudant JSON datastore. 

The demo is deployed to Bluemix and is available from http://activetrack.mybluemix.net . On the demo website you can click on any of the trips on the left menubar, and then click play on the resulting popup to monitor location, speed, and heart rate of the user during the trip. 

The information used in the demo is available via an API. All of the trips shown on the left menu bar are available from using HTTP GET from http://hrtracker.mybluemix.net/api/trips/ . Once you know a specific tripId value from the trips API, you can pull up all of the data points from the trip using HTTP GET to a URL like http://hrtracker.mybluemix.net/api/trip/Amanda-1407354135195/data

More detailed documentation is available from http://activetrack-green.mybluemix.net/docs/

The sample code provided as part of this repository illustrates how to use the REST API to retrieve data. To deploy and test out the sample code, change directory to ```iot``` and execute the following command:

```
cf login
cf push
```

After the command completes successfully, look for the console output specifying the application URL. It should look something like 

```
usage: 256M x 1 instances
urls: iot-random-word.mybluemix.net
```

Open your favorite browser using the URL ending with mybluemix.net (such as iot-random-word.mybluemix.net in the example above) from the console output to access the application. The page should render JSON with the demo data.

##IBM Watson Question Answering (QA) for Travel

The IBM Watson™ Question Answer (QA) for Travel service provides an API, referred to as the QAAPI, that enables you to add the power of the IBM Watson cognitive computing system to your application. With this service, you can connect to Watson, post questions, and receive responses that you can use in your application.

To try the sample Watson QA for Travel application, change directory to ```watson-qa``` and then deploy to Bluemix by executing the following commands:

```
cf login
cf create-service question_and_answer question_and_answer_free_plan myWatsonQa
cf push
```

After the commands complete successfully, look for the console output specifying the application URL. It should look something like 

```
usage: 256M x 1 instances
urls: watson-qa-random-word.mybluemix.net
```

Open your favorite browser using the URL ending with mybluemix.net (such as watson-qa-random-word.mybluemix.net in the example above) from the console output to access the application. 

The page lets you type in a question, like "What should I do in Prague" and ask Watson for document passages with answers. The web page in the index.html file uses Ajax requests to a PHP based service (implemented in ask.php) which in turn communicates with Watson.




