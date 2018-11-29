/*
SQLyog Professional v12.4.1 (64 bit)
MySQL - 5.7.23-log : Database - lojauninove
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lojauninove` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `lojauninove`;

/*Table structure for table `administradores` */

DROP TABLE IF EXISTS `administradores`;

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `administradores` */

insert  into `administradores`(`id`,`nome`,`email`,`senha`,`status`) values 
(1,'Felipe','luiz.felipe.neves3@gmail.com','c62d929e7b7e7b6165923a5dfc60cb56',1),
(3,'felipe 2','teste@teste.com.br','c4ca4238a0b923820dcc509a6f75849b',0);

/*Table structure for table `carrinhos` */

DROP TABLE IF EXISTS `carrinhos`;

CREATE TABLE `carrinhos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario` (`usuario_id`),
  KEY `fk_produtos` (`produto_id`),
  CONSTRAINT `fk_produtos` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `carrinhos` */

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `categorias` */

insert  into `categorias`(`id`,`nome`,`status`) values 
(1,'Brasil',1),
(2,'Inglaterra',0);

/*Table structure for table `pedido_itens` */

DROP TABLE IF EXISTS `pedido_itens`;

CREATE TABLE `pedido_itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(11) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `preco` float DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedidos` (`pedido_id`),
  KEY `fk_pedido_itens` (`produto_id`),
  CONSTRAINT `fk_pedido_itens` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`),
  CONSTRAINT `fk_pedidos` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `pedido_itens` */

insert  into `pedido_itens`(`id`,`pedido_id`,`produto_id`,`preco`,`quantidade`) values 
(1,4,16,200,2),
(2,4,12,150,3);

/*Table structure for table `pedidos` */

DROP TABLE IF EXISTS `pedidos`;

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) DEFAULT NULL,
  `preco_frete` float DEFAULT NULL,
  `status` char(1) DEFAULT 'A' COMMENT 'A=Aberto / P=Pago / R=Recusado',
  `data_cadastro` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_pedido` (`usuario_id`),
  CONSTRAINT `fk_usuario_pedido` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `pedidos` */

insert  into `pedidos`(`id`,`usuario_id`,`preco_frete`,`status`,`data_cadastro`) values 
(4,2,10,'P','2018-11-28');

/*Table structure for table `produtos` */

DROP TABLE IF EXISTS `produtos`;

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_categoria_id` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `preco` float DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `oferta` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_produto_sub_categoria` (`sub_categoria_id`),
  CONSTRAINT `fk_produto_sub_categoria` FOREIGN KEY (`sub_categoria_id`) REFERENCES `sub_categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `produtos` */

insert  into `produtos`(`id`,`sub_categoria_id`,`nome`,`descricao`,`preco`,`quantidade`,`foto`,`status`,`oferta`) values 
(12,1,'SÃ£o Paulo','O SÃ£o Paulo Futebol Clube Ã© uma associaÃ§Ã£o esportiva brasileira fundada em 1930, tendo interrompido suas atividades em maio de 1935, e as retomado em dezembro do mesmo ano',150,10,'1543453921.png',1,1),
(13,1,'Corinthians','O Sport Club Corinthians Paulista Ã© um clube multiesportivo brasileiro sediado na cidade de SÃ£o Paulo. Foi fundado como uma equipe de futebol no dia 1 de setembro de 1910 por um grupo de operÃ¡rios do bairro Bom Retiro.',150,10,'1543453960.png',1,0),
(14,1,'Vasco','Club de Regatas Vasco da Gama Ã© uma entidade sÃ³cio-poliesportiva brasileira com sede na cidade do Rio de Janeiro, fundada em 21 de agosto de 1898 por um grupo de remadores.',150,10,'1543454221.png',1,1),
(15,2,'Arsenal','O Arsenal Football Club Ã© um clube de futebol inglÃªs baseado em Holloway, na Zona Norte de Londres.',200,10,'1543454298.png',1,0),
(16,2,'WestHam','O West Ham United Football Club Ã© um clube de futebol inglÃªs baseado na regiÃ£o leste de Londres. O West Ham Ã© um dos clubes mais tradicionais da Inglaterra e de todo Reino Unido, sendo um dos 25 que jÃ¡ ',200,10,'1543454411.png',1,1);

/*Table structure for table `sub_categorias` */

DROP TABLE IF EXISTS `sub_categorias`;

CREATE TABLE `sub_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_subcategoria_categoria` (`categoria_id`),
  CONSTRAINT `fk_subcategoria_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `sub_categorias` */

insert  into `sub_categorias`(`id`,`categoria_id`,`nome`,`status`) values 
(1,1,'BrasileirÃ£o Serie A',1),
(2,2,'Serie A',1);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cpf` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`nome`,`email`,`cpf`,`senha`,`cep`,`logradouro`,`bairro`,`estado`,`cidade`,`numero`,`status`) values 
(1,'Luiz Felipe Tavares das Neves','luiz.felipe.neves3@gmail.com','37400970860',NULL,'07995000','Avenida Virginia','Jardim Virginia','SP','Francisco Morato',234,1),
(2,'Luiz','luiz-felip-e@hotmail.com','545646466546','c62d929e7b7e7b6165923a5dfc60cb56','07995000','Avenida VirgÃ­nia','','SP','Francisco Morato',294,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
