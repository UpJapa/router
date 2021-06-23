-- --------------------------------------------------------
-- Versão do servidor:           10.4.18-MariaDB - mariadb.org binary distribution
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela webslim.db_admin_usuarios
CREATE TABLE IF NOT EXISTS `db_admin_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  `nome` varchar(128) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado` timestamp NULL DEFAULT NULL,
  `admin` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- Copiando estrutura para tabela webslim.db_api
CREATE TABLE IF NOT EXISTS `db_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `key` varchar(128) DEFAULT NULL,
  `registro` timestamp NULL DEFAULT current_timestamp(),
  `atualizado` timestamp NULL DEFAULT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


-- Copiando estrutura para tabela webslim.db_banner_principal
CREATE TABLE IF NOT EXISTS `db_banner_principal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `texto` text DEFAULT NULL,
  `imagem` varchar(128) DEFAULT NULL,
  `pasta` varchar(20) DEFAULT NULL,
  `target` enum('_self','_blank') DEFAULT NULL,
  `link` varchar(128) DEFAULT NULL,
  `registro` timestamp NULL DEFAULT current_timestamp(),
  `atualizado` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('Y','N') DEFAULT 'Y',
  `tipo` enum('default','text') DEFAULT 'default',
  `ordem` int(11) DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Copiando estrutura para tabela webslim.db_cliente_online
CREATE TABLE IF NOT EXISTS `db_cliente_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_atual` timestamp NULL DEFAULT NULL,
  `sessao` varchar(64) DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `ano` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- Copiando estrutura para tabela webslim.db_grupo_admin
CREATE TABLE IF NOT EXISTS `db_grupo_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `registro` timestamp NULL DEFAULT current_timestamp(),
  `atualizado` timestamp NULL DEFAULT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `db_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `titulo` varchar(64) DEFAULT NULL,
  `fa_fa` varchar(64) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


-- Copiando estrutura para tabela webslim.db_permissao
CREATE TABLE IF NOT EXISTS `db_permissao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `id_tabela` int(11) DEFAULT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `registro` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;



-- Copiando estrutura para tabela webslim.db_produtos
CREATE TABLE IF NOT EXISTS `db_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT 0,
  `id_subcategoria` int(11) DEFAULT 0,
  `titulo` varchar(50) DEFAULT NULL,
  `texto` text DEFAULT NULL,
  `imagem` varchar(128) DEFAULT NULL,
  `pasta` varchar(20) DEFAULT NULL,
  `preco` varchar(50) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `registro` timestamp NULL DEFAULT current_timestamp(),
  `atualizado` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('Y','N') DEFAULT 'Y',
  `ordem` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



-- Copiando estrutura para tabela webslim.db_produtos_categoria
CREATE TABLE IF NOT EXISTS `db_produtos_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `registro` timestamp NULL DEFAULT current_timestamp(),
  `atualizado` timestamp NULL DEFAULT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


-- Copiando estrutura para tabela webslim.db_produtos_galeria
CREATE TABLE IF NOT EXISTS `db_produtos_galeria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `id_referencia` int(11) DEFAULT 0,
  `titulo` varchar(50) DEFAULT NULL,
  `pasta` varchar(20) DEFAULT NULL,
  `imagem` varchar(128) DEFAULT NULL,
  `imagem_original` varchar(50) DEFAULT NULL,
  `registro` timestamp NULL DEFAULT current_timestamp(),
  `atualizado` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('Y','N') DEFAULT 'Y',
  `ordem` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;



-- Copiando estrutura para tabela webslim.db_produtos_subcategoria
CREATE TABLE IF NOT EXISTS `db_produtos_subcategoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `ordem` int(11) DEFAULT NULL,
  `registro` timestamp NULL DEFAULT current_timestamp(),
  `atualizado` timestamp NULL DEFAULT NULL,
  `status` enum('Y','N') DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;



-- Copiando estrutura para tabela webslim.db_sub_menu
CREATE TABLE IF NOT EXISTS `db_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) DEFAULT NULL,
  `tabela_url` varchar(64) DEFAULT NULL,
  `titulo` varchar(64) DEFAULT NULL,
  `registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ordem` int(11) NOT NULL DEFAULT 0,
  `status` enum('Y','N') DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;



-- Copiando estrutura para tabela webslim.db_userspasswordsrecoveries
CREATE TABLE IF NOT EXISTS `db_userspasswordsrecoveries` (
  `idrecovery` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `desip` varchar(45) NOT NULL,
  `dtrecovery` datetime DEFAULT NULL,
  `dtregister` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idrecovery`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;