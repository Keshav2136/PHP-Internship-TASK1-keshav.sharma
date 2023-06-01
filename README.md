# Internship TASK1 by Keshav Sharma.

`PHP & MySQL`
<br><br><br>
## MySQL server
# Create a database, with a `User` Table:
```
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL
);
```

## Rename .env-example to `.env`
## Add all the `secrets` / details of the database in the `.env` file