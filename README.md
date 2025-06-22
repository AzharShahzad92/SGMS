# Study Group Management System (SGMS)
This project is a prototype implementation of a Study Group Management Tool for the WorkTogether event organized by the student representatives of the Faculty of Computer Science at TU Chemnitz. The tool is designed to simplify the process of forming and managing study groups for collaborative learning sessions. Pelase scroll to the end of this file for the configuration.

# Project Goals
The main goal is to assist students in finding and managing suitable study groups during WorkTogether sessions. The platform provides both administrative (FSR:IF) and student interfaces, ensuring efficient session creation, visibility control, group organization, and real-time participation tracking.

# Technologies Used
  PostgreSQL as the database system
  
  PL/pgSQL for implementing database logic
  
  Backend: PHP
  
  Frontend: Html, CSS, Javascript

# Database Functionality
Centralized management using PostgreSQL
Business logic implemented directly with PL/pgSQL
Handles:
  WorkTogether sessions (time-bound, visibility managed)
  Study groups (topic, description, participant limit)
  Join/leave mechanics
  Ownership transfer
  Auto-removal of empty groups
  Auto-hide expired meetings

# Frontend Features
🔐 Admin Panel
  	  Add, list, update, and delete WorkTogether meetings
      Change visibility of meetings
      Auto-hide meetings once expired

👨‍🎓 Student View
    View only visible future meetings
    Create study groups (with topic, description, size limit)
    Join/leave groups (one group at a time)
    Transfer of group ownership on leave
    Auto-deletion of empty groups

# Configuring Postgresql 
• Install the postgresql 
• Open the pgadmin 
• There are two options to load the database and functions 
• The backup is provided and you just have to right click the database and click 
restore. Load the backup file and you are all set. 
• The other option is to load the script provided but this consumes much time.

# Configuring Front-end and server side 
• First you need to install any server that supports php. The development environment was 
locally in wamp. It’s advised to use wamp to follow further settings. 
• After the installation move the folder name “fsrif” to the ‘www’ directory of your 
installation of wamp. It’s typically “C:\wamp64\www”. 
• You have to set virtual host in order to load the project. You can visit https://john-
dugan.com/wamp-vhost-setup/ to see the details of setting up. 
• After that, you have to enable extension ‘pgsql’. To enable it, left click on ‘W’ icon of 
wamp in the taskbar and navigate to php->php.ini. Search for pgsql and remove the 
semicolon on the start of the line. 
• The installed php version only supports md5 encryption for accessing the pgsql database. 
You have to manually change the encryption type from ‘scram-sha-256’ to ‘md5’ in 
postgresql and for that please visit : 
https://stackoverflow.com/questions/43333053/change-postgresql-password-encryption-
from-md5-to-sha. Alternatively, you can install a php plugin to support ‘scram-sha-256’ 
encryption.

# Credentials 
• After completing all above steps, please create a new role in agadmin with username as 
“root” and password “PAZinTU_426” and grant right to access the database. 
• FSR:IF Interface: To access this interface the username is “Azhar” and password is 
“P@kistan12“. 
• The student can signup easily on the login page.
