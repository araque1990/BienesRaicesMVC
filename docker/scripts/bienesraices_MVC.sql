CREATE TABLE `vendedores` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(45) DEFAULT NULL,
    `apellido` varchar(45) DEFAULT NULL,
    `telefono` varchar(10) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE `usuarios` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(60) DEFAULT NULL UNIQUE,
    `password` char(60) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4;

CREATE TABLE `propiedades` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `titulo` varchar(60) DEFAULT NULL,
    `precio` decimal(10, 2) DEFAULT NULL,
    `imagen` varchar(200) DEFAULT NULL,
    `descripcion` longtext,
    `habitaciones` int(11) DEFAULT NULL,
    `wc` int(11) DEFAULT NULL,
    `estacionamiento` int(11) DEFAULT NULL,
    `vendedorId` int(11) DEFAULT NULL,
    `creado` date DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `vendedorId_idx` (`vendedorId`),
    CONSTRAINT `vendedorId` FOREIGN KEY (`vendedorId`) REFERENCES `vendedores` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 88 DEFAULT CHARSET = utf8;

INSERT INTO
    `vendedores` (
        `id`,
        `nombre`,
        `apellido`,
        `telefono`
    )
VALUES (
        1,
        'Juan',
        'De la torre',
        '091390109'
    ),
    (
        2,
        'KAREN ACT',
        'Perez',
        '0123456789'
    );

INSERT INTO
    `propiedades` (
        `id`,
        `titulo`,
        `precio`,
        `imagen`,
        `descripcion`,
        `habitaciones`,
        `wc`,
        `estacionamiento`,
        `vendedorId`,
        `creado`
    )
VALUES (
        67,
        'Casa en el Lago ',
        1500000.00,
        'adaef2a36d051912d17aebd4c08db0a9.jpg',
        'dio consectetur at. Interdum et malesuada fames ac ante ipsum primis in faucibus.',
        1,
        2,
        3,
        1,
        '2026-01-01'
    ),
    (
        68,
        'Casa Moderna',
        1300000.00,
        '71731e85547ff4e33ebcac7f48044cc3.jpg',
        'dio consectetur at. Interdum et malesuada fames ac ante ipsum primis in faucibus.',
        3,
        2,
        1,
        1,
        '2026-01-01'
    ),
    (
        69,
        'Casa con Piscina',
        1350000.00,
        '15d436da7aedfc95d4e830e087ff6e61.jpg',
        'dio consectetur at. Interdum et malesuada fames ac ante ipsum primis in faucibus.',
        3,
        1,
        2,
        1,
        '2021-01-01'
    ),
    (
        70,
        'Casa Unifamiliar',
        700000.00,
        'eeba1c2e2ac0b721043146e29723f755.jpg',
        'dio consectetur at. Interdum et malesuada fames ac ante ipsum primis in faucibus.',
        3,
        2,
        1,
        1,
        '2026-01-01'
    ),
    (
        72,
        'Casa en Promoción',
        800000.00,
        'b78fe4d74d435ffa1c508b89baa62a5d.jpg',
        'dio consectetur at. Interdum et malesuada fames ac ante ipsum primis in faucibus.',
        3,
        2,
        1,
        1,
        '2026-01-01'
    ),
    (
        87,
        ' Casa en la Periferia',
        650000.00,
        '62cb49f957e98d98e44cb548206525e0.jpg',
        'dio consectetur at. Interdum et malesuada fames ac ante ipsum primis in faucibus.',
        3,
        3,
        3,
        1,
        '2026-01-01'
    );