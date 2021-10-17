# Yes-Asset-Manager-
A basic web applications for asset management with a focus on computers and computer attributes. 

Evolved from Computer-Technician-Tracker https://github.com/ahuckphin/Computer-Technician-Tracker/

Credits to w3schools.com/ for thier CSS file. - https://www.w3schools.com/w3css/w3css_downloads.asp

Credits to @kreativekorp for this barcode generating script. https://github.com/kreativekorp/barcode

Successfully deployable in local host environment with XAMPP and phpMyAdmin.

Developed with Visual Studio Code, XAMPP and Edge (Chromium version). 

## Features
![Image of Screenshot](https://raw.githubusercontent.com/ahuckphin/Yes-Asset-Manager/picture-branch/screenshot%20of%20landing%20page.png)
### 0. Index
Simple landing page with links to other pages plus disclaimers. 

### 1. Add a New Asset
Input hostname, make and model, serial number and windows key into `details` table.

### 2. Browse All Asset
See all asset(s) and thier attributed hostname, make and model, serial number, windows key and status. 

### 3. Check-in Assets
Change status of user selected assets to "Ready for Checkout". Assets marked with a status of "Checked out for Permanent Loan" and "Ready for Checkout" omitted from being displayed in this feature. 

### 4. Browse and Checkout Assets for Event
Checkout asset with option to disclose event name, event person in charge (PIC) and additional remarks. Changes status of user selected assets in `details` table to "Checked out for event" and adds a new row into `movementlog` table wiht aforementioned details. 

### 5. Browse and Checkout Assets for Individual
Checkout asset with option to disclose individual name and additional remarks. Changes status of user selected assets in `details` table to "Checked out for individual" and adds a new row into `movementlog` table wiht aforementioned details. 

### 6. Browse and Checkout Assets for Permanent Loan
Checkout asset with option to disclose organization name, organization representative name, organization representative contact details, organization representative identity card number and additional remarks. Changes status of user selected assets in `details` table to "Checked out for permanent loan" and adds a new row into `movementlog` table wiht aforementioned details. Permanent loan can be equal to written off. 

### 7. Browse and Checkout Assets for Refurbishment
Checkout asset with option to disclose technician name and additional remarks. Changes status of user selected assets in `details` table to "Checked out for refurbishment" and adds a new row into `movementlog` table wiht aforementioned details. 

### 8. Browse and Checkout Assets for Temporary Loan
Checkout asset with option to disclose organization name, organization representative name, organization representative contact details, organization representative identity card number, estimated checkin date and additional remarks. Changes status of user selected assets in `details` table to "Checked out for temporary loan" and adds a new row into `movementlog` table wiht aforementioned details. 

### 9. Find Refurbishment and Movement Log(s) for an Asset
Enter hostname and be returned from details table hostname printed in code 128 barcode, make and model, serial number, windows key, windows key in code 128 barcode, status, list of movement and list of past completed work.

### 10. New Backup Refurbishment Log 
Enter hostname and check off work done, enter remarks and or enter Windows key to be added into log table with Window key being updated into details table.

### 11. New Restore Refurbishment Log
Enter hostname and check off work done, enter remarks and or enter Windows key to be added into log table with Window key being updated into details table.

### 12. Yes Asset Manager User Guides
-coming soon- 

## New Backup Refurbishment Log vs New Restore Refurbishment Log
The reason for the existence of 2 different new log is because of adoption of the concept of disk imaging. You do all steps on 1 computer, image the disk and restore the image on another laptop allowing the skipping of many steps on the other laptop.  

## Limitations

* Refreshing page will resubmit the form. 

## My work is different. How can I edit the work list? 
There is unfortunatenly no front end interface to manipulate the work list. You will have to open `new-log-backup.php` and or `new-log-restore.php` file. Each work comprises of 2 lines of code. Example:
```
<input type="checkbox" name="work[]" value="Ubuntu Hostname set. ">
<label for="work[]">Ubuntu Hostname set. </label><br>
```
In this case, `Ubuntu Hostname set` is the work. You can use the template below to add your own work:
```
<input type="checkbox" name="work[]" value="INSERT_WORK_HERE ">
<label for="work[]">INSERT_WORK_HERE </label><br>
```
Replace `INSERT_WORK_HERE` with your own work. Do leave a space after the work for best results in database. 


## Database
The database this application links to is called "yesassetmanager" and comprises of 3 tables.

Create table SQL commands generated by `SHOW CREATE TABLE` command. 

Note that UserID coloumn currently not used. 

You will need to manually insert database location, username and password into each file individually during installation.

### Log Table:
```
CREATE TABLE `log` (
  `LogID` int(11) NOT NULL AUTO_INCREMENT,
  `Hostname` varchar(10) NOT NULL,
  `Date` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `Work` text NOT NULL,
  `Remarks` varchar(1000) NOT NULL,
  PRIMARY KEY (`LogID`),
  KEY `Hostname_Validity` (`Hostname`),
  CONSTRAINT `Hostname_Validity` FOREIGN KEY (`Hostname`) REFERENCES `details` (`Hostname`)
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8mb4'
```


### movementlog Table: 
```
CREATE TABLE `movementlog` (
  `LogID` int(11) NOT NULL AUTO_INCREMENT,
  `Hostname` varchar(10) NOT NULL,
  `Date` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `Destination` text NOT NULL,
  `UserID` int(11) NOT NULL,
  `Remarks` varchar(1000) NOT NULL,
  PRIMARY KEY (`LogID`),
  KEY `Hostname_Validity` (`Hostname`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4
```

### refurbishmentlog Table: 
```
CREATE TABLE `refurbishmentlog` (
  `LogID` int(11) NOT NULL AUTO_INCREMENT,
  `Hostname` varchar(10) NOT NULL,
  `Date` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `Work` text NOT NULL,
  `UserID` int(11) NOT NULL,
  `Remarks` varchar(1000) NOT NULL,
  PRIMARY KEY (`LogID`),
  KEY `Hostname_Validity` (`Hostname`),
  CONSTRAINT `Hostname_Validity` FOREIGN KEY (`Hostname`) REFERENCES `details` (`Hostname`)
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8mb4
```

## Background
This application was developed after dissatisfaction towards limitations alternative available applications posed. 


## Coming Soon Improvements

* Yes Asset Manager User Guides
* Redesigned add asset page 
* User account implementation  
