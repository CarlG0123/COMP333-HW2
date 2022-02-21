# SQL README
A list of SQL queries to run in order to set up your database to be identical to mine.

## 1. Creating Tables
```sql
CREATE TABLE users 
    (username varchar(255) PRIMARY KEY, 
    password varchar(255));

CREATE TABLE ratings
    (id INTEGER PRIMARY KEY AUTO_INCREMENT, 
    username varchar(255), 
    song varchar(255), 
    rating INTEGER(1));

CREATE TABLE artists
    (song varchar(255) PRIMARY KEY, 
    artist varchar(255));

```

## 2. Set up Cascade with Username as a Foreign Key
```sql
    ALTER TABLE ratings ADD CONSTRAINT FK_ratings_users 
        FOREIGN KEY ratings(username) REFERENCES users(username)
        ON DELETE CASCADE;

    ALTER TABLE ratings ADD CONSTRAINT FK_ratings_users 
        FOREIGN KEY ratings(song) REFERENCES artists(song)
        ON DELETE CASCADE;
```


## 3. Ratings Table
```sql
INSERT INTO users (username, password) VALUES 
    ("Amelia-Earhart", "Youaom139&yu7"),
    ("Otto", "StarWars2*");

INSERT INTO ratings (username, song, rating) VALUES 
    ("Amelia-Earhart", "Freeway", 3),
    ("Amelia-Earhart", "Days of Wine and Roses", 4),
    ("Otto", "Days of Wine and Roses", 5),
    ("Amelia-Earhart", "These Walls", 4);

INSERT INTO artists (song, artist) VALUES 
    ("Freeway", "Aimee Mann"),
    ("Days of Wine and Roses", "Bill Evans"),
    ("These Walls", "Kendrick Lamar");
```
