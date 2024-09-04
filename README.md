# EOP ASSIST 4.0 #

## A Software Application for K-12 Schools, School Districts, and State Agencies ##

EOP ASSIST 3.0 is the REMS TA Center’s recently updated software application designed to help schools create and update high-quality school emergency operations plans (EOPs) that are customized to address a range of threats and hazards. This application, available to users free of charge, walks users through the six-step planning process—as recommended by the U.S. Department of Education, the U.S. Department of Homeland Security and Federal Emergency Management Agency, the U.S. Department of Justice and Federal Bureau of Investigation, and the U.S. Department of Health and Human Services—to develop a downloadable school EOP.

### This is the development repository for EOP ASSIST  ###

* Version 4.0
* [Learn More](http://rems.ed.gov/EOPAssist.aspx)

### Version 4.0 Changes ###

1. Resource Toolkit updates
2. Page information updates
3. A version with support for the new PHP 7 can now be downloaded separately and used

### Version 3.0 Changes ###
1. Added Prepolpulation of Threats & Hazards and functions at the State and District Level
2. Added ability to delete schools and all their information and users
3. Added Ability to delete and entire district
4. Added Ability to delete users from the system
5. Added Time-Out feature for super administrators to be able to configure custom time-out of sessions, also set the default time-out to 60 minutes instead of the 5 minutes that was used in version 2.0
6. Added ability for all administrators to export the user's list to an excel spread sheet
7. Added ability for the resource toolkit items to be added dynamically by super administrators, the default toolkit resources were also updated
8. All users can now add custom function on Step 3 page 4



### How to Setup/Install  ###

EOP ASSIST is a web application developed for PHP, MySQL/MS SQL and Apache/IIS 7 server software, you'll need a web server environment setup before installing EOP ASSIST.

### Dependencies ###
1- A web server, either Apache or IIS 5,6 or 7

   * Apache should be setup with the rewrite module enabled
   * IIS 7 should have the URL Rewrite 2.0 module installed and enabled [Click here for more](http://www.iis.net/downloads/microsoft/url-rewrite)

2- A compatible database, MySQL and MS SQL Server are currently supported

   Set Up a Database and Privileged User
   After configuring your Web server and PHP to work with a database system using MySQL or MS SQL Server, you will need to create a database.

3- PHP scripting language Version 5.6.x or 7.x.x

### Installation Steps ###

STEP 1: 

Download the package as a zipped file. extract all the files to your web server root directory. **Note** "*Make sure you have the .htaccess file for Apache or the web.config file for IIS copied*"

STEP 2:

Make sure you have the following directory structure in your server root directory:
-root directory
  |- application/
  |- assets/
  |- system/
  |- uploads/
  |- index.php
  |- .htaccess
  |- web.config

STEP 3:

Locate the file application/config/settings.php and grant write permissions to it. Also grant write permissions to the uploads folder.

STEP 4: **Initialize the App**

Next, you will need to run an install script that will set up the database tables and initialize the application. Make sure you have created a database and a database user before you continue.
Open your browser and navigate to the following URL: http://localhost/install
You will see an installation screen. 
Select the level of hosting at which you are installing EOP ASSIST. 
State-level hosting means that a state agency is hosting the application. 
District-level hosting, on the other hand, means that a district or individual school is hosting the application. 
Select State Level or District Level, as appropriate, and click the Save and Continue button.

STEP 4:

The system will run a systems requirements verification check to make sure that you have all the technologies and dependency PHP libraries needed to run EOP ASSIST. If the system passes, you’ll be prompted to enter the server and database information. Enter the following information into the appropriate fields.
1. For Database Type, select the database you are using. This should either be MySQL or SQL Server.
2. Database Host is the machine or server IP that hosts the database. If your database is hosted on the same server machine, type localhost or 127.0.0.1 in the field. Otherwise, enter the database server IP address in the field.
3. In the Database Name field, enter the name of the database you created earlier. This should be eopassist.
4. In the Database Username field, enter the user name of the database.
5. In the Database User Password field, enter the password of the database user.
6. Click the Save and Continue button.

STEP 5: **Super Admin setup**

Next, you will need to set up the Super Administrator account. This is EOP ASSIST’s overall administrator who is responsible for setting up the application for other users and for managing the database. As such, the Super Administrator has all management functionality of the application and should be used by IT personnel. To begin, create a user ID and password, and type your name and email, which are all required fields. Additionally, if you have enabled state-level hosting during the installation process, select the appropriate state. Make sure you save this information, so that you can log in again in the future.

STEP 6:

After installation, go to the http://localhost/ , you will be redirected to the Log In page. This is where you may log in with the Super Administrator log in credentials that you just created. It is recommended that there are at least three representatives from your entity with access to the Super Administrator log in credentials.