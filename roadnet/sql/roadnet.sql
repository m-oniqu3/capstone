DROP DATABASE IF EXISTS roadnet;
CREATE DATABASE roadnet;
use roadnet;
DROP TABLE IF EXISTS employee;
DROP TABLE IF EXISTS report;
DROP TABLE IF EXISTS reportUpdate;
 
CREATE TABLE employee (
    eid int NOT NULL UNIQUE AUTO_INCREMENT,
    fname VARCHAR(30) NOT NULL,
    lname VARCHAR(30) NOT NULL,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(25) NOT NULL,
    email VARCHAR(50) NOT NULL,
    parish VARCHAR(25) NOT NULL,
    role VARCHAR(20) NOT NULL,

    PRIMARY KEY (eid)
);

INSERT INTO employee (fname, lname, username, password, email, parish, role) VALUES ('Sean', 'Aung', 'saung', 'saung123', 'seanaung@roadnet.com', 'Hanover', 'Admin');
INSERT INTO employee (fname, lname, username, password, email, parish, role) VALUES ('Monique', 'McIntyre', 'mmc', 'mmc123', 'moniquemcintyre@roadnet.com', 'St. James', 'Staff');
INSERT INTO employee (fname, lname, username, password, email, parish, role) VALUES ('Jeante', 'Boreland', 'jboreland', 'jboreland123', 'jeanteboreland@roadnet.com', 'St. James', 'Parish Manager');
INSERT INTO employee (fname, lname, username, password, email, parish, role) VALUES ('Lyle-Anthony', 'Golding', 'lylegold', 'lylegold123', 'lylegolding@roadnet.com', 'St. James', 'Director');
INSERT INTO employee (fname, lname, username, password, email, parish, role) VALUES ('Roxy', 'Grant', 'rgrant', 'rgrant123', 'roxygrant@roadnet.com', 'St. James', 'Contractor');


CREATE TABLE report (
    reportID int(11) NOT NULL AUTO_INCREMENT, 
    firstname varchar(25) NOT NULL,
    lastname varchar(25) NOT NULL,
    telephone varchar(11) NOT NULL,
    parish varchar(25) NOT NULL,
    town varchar(30) NOT NULL,
    gpscoord varchar(65) NOT NULL,
    address varchar(70) NOT NULL,
    direction varchar(150) NOT NULL,
    incident varchar(25) NOT NULL,
    description varchar(500) NOT NULL,
    media varchar(500) NOT NULL,
    vstatus varchar(20) NOT NULL,
    rdate date NOT NULL,
    priority VARCHAR(10) NOT NULL,
    assignedTo VARCHAR(30) NULL,
  
    PRIMARY KEY (reportID)

);

INSERT INTO report(firstname, lastname, telephone, parish, town, gpscoord, address, direction, incident, description, media, vstatus, rdate, priority) VALUES ("Jeante", "Boreland", "18761234567", "St. James", "Bogue Estate", "Latitude: 18.44097 Longitude: -77.924004", "34 Marlin Avenue", "Turn right after entering Bogue Blvd road", "Potholes", "Large pothole near right across the big yellow house", "incident.jpeg", "Pending", "2021-04-24", "Critical");


CREATE TABLE reportUpdate (
    reportID int(11) NOT NULL,
    updateNo int(11) NOT NULL,
    updateStatus VARCHAR(30) NOT NULL,
    updateMsg VARCHAR(200) NOT NULL,

    PRIMARY KEY (reportID, updateNo),
    
    FOREIGN KEY (reportID) REFERENCES report(reportID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE staffMessage (
    reportID int(11) NOT NULL,
    txtMessage VARCHAR(300) NOT NULL,
    username VARCHAR(30) NOT NULL,
    messageID int(11) NOT NULL,
    mDate date NOT NULL,
    mReceiver VARCHAR(30) NOT NULL,

    PRIMARY KEY (reportID, username, messageID),

    FOREIGN KEY (reportID) REFERENCES report(reportID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (username) REFERENCES employee(username) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE pmAnnouncement (
    announcementID int(11) NOT NULL AUTO_INCREMENT,
    receiver VARCHAR(30) NOT NULL,
    aDate date NOT NULL,
    aMessage VARCHAR(300) NOT NULL,
    aTitle VARCHAR(50) NOT NULL,
    username VARCHAR(30) NOT NULL,
    

    PRIMARY KEY (username, announcementID),

    FOREIGN KEY (username) REFERENCES employee(username) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE drAnnouncement (
    announcementID int(11) NOT NULL AUTO_INCREMENT,
    receiver VARCHAR(30) NOT NULL,
    aDate date NOT NULL,
    aMessage VARCHAR(300) NOT NULL,
    aTitle VARCHAR(50) NOT NULL,
    username VARCHAR(30) NOT NULL,
    

    PRIMARY KEY (username, announcementID),

    FOREIGN KEY (username) REFERENCES employee(username) ON DELETE CASCADE ON UPDATE CASCADE
);