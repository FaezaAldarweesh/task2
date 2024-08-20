Post Management System
This project is a simple post management system built with Object-Oriented PHP. The system allows users to perform the following operations:

Add a Post
Delete a Post
Edit a Post
View All Posts
View Post Details
Project Structure
1. Database Class
Type: Abstract Class
Purpose: Serves as a template for database operations. Other classes inherit from this class.
Includes:
A method to connect to the database.
CRUD methods (Create, Read, Update, Delete) that are implemented in the child classes.
2. Post Class
Inheritance: Inherits from the Database class.
Purpose: Implements the CRUD operations specific to posts.
Includes:
A constructor for establishing a database connection.
Methods for CRUD operations.
A destructor to close the database connection.
Traits: A trait is used to organize and possibly reuse the methods across other classes, improving code readability and structure.
3. Validation Class
Purpose: Handles validation of form inputs.
Encapsulation: Properties are private, ensuring they cannot be directly accessed or modified without meeting specific conditions.
Includes:
Methods to sanitize inputs (e.g., trim, stripslashes, htmlspecialchars).
Setter methods to validate input values and handle error messages for both adding and editing posts.
4. Views
Purpose: Provides the user interface using Bootstrap for styling.
Includes:
Pages for adding, editing, viewing, and listing posts.
Each page creates an instance of the Post class and calls the appropriate method to perform the requested operation.
How to Run the Project
Place the project folder in the xampp/htdocs directory.
Start Apache and MySQL using XAMPP.
Create the database in PHPMyAdmin:
Database Name: blog_db
The SQL script to create the database is included in the blog_db.sql file.
Access the project by navigating to http://localhost/faeza%20aldarweesh%20task_2/views/list_post.php.
Technologies Used
Back-end: PHP, SQL
Front-end: Bootstrap
