# Application
Please see chapter 5 in the Technical Handbook for a detailed explination of the application.

# Note
The site is hosted on a school server and as a result some functions do not properly work. 
An order can be placed but the receipt after purchase will not show correctly. 
However, viewing previous orders or generating a monthly/yearly report will show the newest orders inserted. 

This was a good learning experience and helped in understanding how a web application can be connected
to a properly designed database. 

# About Company #
  The fictional company orders products on behalf of clients who own vending machines. The shipping company 
then drives out and stocks the machines. The design process for this database considers two types of employees and the work revolved around 
their job dututies. The two employee types are a delivery driver and a dispatcher.
  Driver: Responsible for picking up orders from a warehouse and deliverying them to vending machines.
  Dispatcher: Repsonsible for placing orders and creating routes for drivers. 
## ER MODEL ##   
 The following ER diagram shows a finialized design for the the database schema.<br>
 ![ER MODEL](https://github.com/EdwinGonzalez23/database_vending_machine_comp/tree/master/database-design/Vending_Machine_Comp_ER.png)
## Techincal Handbook  
The following pdf is a book on the design process of the databse.<br> 
![Database Technical Book](https://github.com/EdwinGonzalez23/database_vending_machine_comp/blob/master/database-design/Database_VendingMachine_Company.pdf)

# database_vending_machine_comp 
First attempt at a database design for a shipping/ordering company.
This repository consist of three folders: PSQL, database-design, startbootstrap-sb-admin-2-gh-pages

### PSQL 
Contains the tables and data insertion for the database. 
       tablescreate.sql has no constraints. Inside PSQL/TableswithConstraints the database relations with contraints 
       can be found as well as a file to insert random data. 
       
### startbootstrap-sb-admin-2-gh-pagess
This folder contains free webapp templates found online that have been modified
      to create a simple application that can interface with the database. 
      The webapp can be found here: http://delphi.cs.csub.edu/~egonzale/startbootstrap-sb-admin-2-gh-pages/
      The webapp allows the user to utilize the side navigation bar to place an order, view the order history, 
      bring up a specific order by ID, view the route history, or generate some reports. 
      
   Types of Reports
   * Items Report - Generates a report of which items have been bought from each supplier, the amount 
   of items bought, and totals for each supplier as well as a grand total. 
   * Monthly Report - A report on how much was spent on each supplier in the most recent month. 
   * Yearly Report - A report on how much was spent on each suppler in the most recent year.
   * Custom Report - Can generate an Items Report with custom parameters or a custom years report.
   
### database-design 
This folder contains two files which relate to the design of the databse. 
* Database_VendingMachine_Company.pdf - A technical/educational/analytical handbook on the design process 
for the company database.
  * Chapter 1 - Design requirements, Design Process, Entity/Relationships descriptions, ER diagram<br>
  The process beings with researching the company requirements. This research seeks the answer to questions such as 
  who are the users, what do the users need to perform, what is the company asking for, what resources will the company utilize or   potentially utilize in the future.<br>
  Another important requirement is the work flow of the company, or how the company plans to operate. Once these questions are 
  answered, an ER Diagram Schema can be created to show a high-level view of the companies database.<br>
  
  * Chapter 2 - Converting to Relational Model<br>
  The ER Schema must be converted to a Relational Model in order to implement a Relational Database. This chapter breaks down 
  the process of mapping Entities/Relationships from chapter 1 and converting them to Relations(tables). Mapping considers 
  1 to 1, M to N, and M to 1 relationships as well as Strong/Weak entities.<br>
  10 practical, non-trivial queries are also answered in the theoretical langaues: Relational Algebra, Relational Calculus, and Domain Tupble Calculus. 
  
  *  Chapter 3 - Implementation of the Relational Database. <br>
  The relational model is used to implement a relational database. This database is built on the POSTGRESQL DBMS.
  
  * Chapter 4 - Triggers/Stored procedures/Views. Analysis of other database management systems.
  
  * Chapter 5 - Graphical User Interface/Web Application for three main user groups. 
             Client, Driver, Dispatcher
             
* ER MODEL - An Entitiy Relationship diagram that models the schema of the database                
