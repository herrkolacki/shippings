/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  robus
 * Created: 2020-08-23
 */

CREATE TABLE zones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code char(2) UNIQUE NOT NULL,
    zone_amount DECIMAL(8,2) NOT NULL,
    created DATETIME,
    modified DATETIME
)CHARSET=utf8mb4;

CREATE TABLE shippings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    postcode char(5) NOT NULL,
    total_order_amount DECIMAL(8,2) unsigned NOT NULL,
    shipping_order_amount DECIMAL(6,2) unsigned NOT NULL,
    long_product tinyint(1) default 0,
    zone_id int not null, 
    created DATETIME,
    modified DATETIME,
    FOREIGN KEY user_key (zone_id) REFERENCES zones(id)
)CHARSET=utf8mb4;