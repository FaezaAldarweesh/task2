create database blog_db;



create table posts (
		    id INT AUTO_INCREMENT PRIMARY KEY, 
            title varchar (255),
		    content TEXT,
		    author VARCHAR(100), 
		    created_at timestamp NULL DEFAULT NULL,
		    updated_at timestamp NULL DEFAULT NULL
		    );