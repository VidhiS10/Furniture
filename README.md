# Furniture
backend application[admin side]

CREATE TABLE tbl_user_address (
    address_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(50),
    phone VARCHAR(15),
    pincode VARCHAR(10),
    house_no VARCHAR(100),
    area VARCHAR(100),
    city VARCHAR(50),
    state VARCHAR(50),
    landmark VARCHAR(100),
    address_type VARCHAR(20),
    is_default TINYINT(1) DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES tbl_user(user_id)
);
