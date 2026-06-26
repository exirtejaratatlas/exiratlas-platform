-- ETA Portal — database schema (MySQL / MariaDB)
-- Import this once via phpMyAdmin into your portal database.
SET NAMES utf8mb4;
SET time_zone = '+03:30';

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','partner') NOT NULL DEFAULT 'partner',
  active TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS customers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(20) UNIQUE,
  legal_name VARCHAR(190) NOT NULL,
  industry VARCHAR(60),
  sub_segment VARCHAR(120),
  city VARCHAR(80),
  country VARCHAR(80) DEFAULT 'Iran',
  status ENUM('Lead','Active','Dormant','Blacklisted') DEFAULT 'Lead',
  payment_rating ENUM('A','B','C','D') DEFAULT NULL,
  risk_flag VARCHAR(40) DEFAULT 'none',
  source VARCHAR(120),
  owner_user_id INT DEFAULT NULL,
  notes TEXT,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX (owner_user_id), INDEX (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_id INT NOT NULL,
  full_name VARCHAR(120) NOT NULL,
  title VARCHAR(120),
  decision_power ENUM('decision-maker','influencer','user') DEFAULT NULL,
  phone VARCHAR(60),
  email VARCHAR(190),
  language VARCHAR(20) DEFAULT 'FA',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX (customer_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS suppliers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(20) UNIQUE,
  name VARCHAR(190) NOT NULL,
  country VARCHAR(80),
  supplier_type ENUM('Manufacturer-direct','Stockist','Trader','Agent') DEFAULT 'Trader',
  product_categories VARCHAR(255),
  brands VARCHAR(255),
  region_strength VARCHAR(120),
  currency VARCHAR(10) DEFAULT 'USD',
  payment_terms VARCHAR(120),
  lead_time_days INT DEFAULT NULL,
  sanction_route VARCHAR(40) DEFAULT 'unknown',
  reliability_rating TINYINT DEFAULT NULL,
  status ENUM('Active','Trial','Inactive','Blacklisted') DEFAULT 'Trial',
  notes TEXT,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS manufacturers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(20) UNIQUE,
  brand_name VARCHAR(120) NOT NULL,
  oem_legal_name VARCHAR(190),
  country_origin VARCHAR(80),
  product_lines VARCHAR(255),
  sanction_status ENUM('open','restricted','blocked-direct','gray-market-only') DEFAULT 'restricted',
  equivalent_brands VARCHAR(255),
  notes TEXT,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS rfqs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  code VARCHAR(20) UNIQUE,
  customer_id INT DEFAULT NULL,
  date_received DATE,
  deadline DATE DEFAULT NULL,
  status ENUM('New','Sourcing','Costing','Quoted','Negotiation','Won','Lost','Cancelled') DEFAULT 'New',
  currency VARCHAR(10) DEFAULT 'USD',
  incoterms VARCHAR(20),
  priority ENUM('high','medium','low') DEFAULT 'medium',
  owner_user_id INT DEFAULT NULL,
  notes TEXT,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX (customer_id), INDEX (status), INDEX (owner_user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS rfq_lines (
  id INT AUTO_INCREMENT PRIMARY KEY,
  rfq_id INT NOT NULL,
  description VARCHAR(255) NOT NULL,
  brand_requested VARCHAR(120),
  quantity DECIMAL(14,2) DEFAULT NULL,
  unit VARCHAR(30),
  target_price DECIMAL(14,2) DEFAULT NULL,
  INDEX (rfq_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS offers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  rfq_id INT NOT NULL,
  supplier_id INT DEFAULT NULL,
  description VARCHAR(255),
  quoted_price DECIMAL(14,2) DEFAULT NULL,
  currency VARCHAR(10) DEFAULT 'USD',
  lead_time_days INT DEFAULT NULL,
  validity_date DATE DEFAULT NULL,
  outcome ENUM('selected','not-selected','no-reply') DEFAULT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX (rfq_id), INDEX (supplier_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
