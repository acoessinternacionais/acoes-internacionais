
-- Estrutura de banco de dados para o site de investimentos

-- 1. Tabela de usuários
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  email VARCHAR(100),
  role ENUM('admin', 'user') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabela de ativos (ações, FIIs e ETFs)
CREATE TABLE assets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tipo ENUM('acao', 'fii', 'etf') NOT NULL,
  nome VARCHAR(100) NOT NULL,
  codigo VARCHAR(20) NOT NULL UNIQUE,
  imagem_url VARCHAR(255),
  ativo BOOLEAN DEFAULT TRUE
);

-- 3. Tabela de dados dos ativos (atualizados em tempo real)
CREATE TABLE asset_data (
  id INT AUTO_INCREMENT PRIMARY KEY,
  asset_id INT NOT NULL,
  variacao DECIMAL(6,2),
  percentual_variacao DECIMAL(6,2),
  ultimo_dividendo DECIMAL(10,4),
  volume BIGINT,
  cotacao DECIMAL(10,4),
  data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (asset_id) REFERENCES assets(id) ON DELETE CASCADE
);

-- 4. Tabela de notícias
CREATE TABLE noticias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255),
  descricao TEXT,
  fonte VARCHAR(255),
  data_publicacao DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 5. Tabela de logs do administrador
CREATE TABLE admin_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  admin_id INT,
  acao VARCHAR(255),
  data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (admin_id) REFERENCES users(id)
);
