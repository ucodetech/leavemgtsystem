
CREATE TABLE `agreementForStudyLeave` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `agreeDate` date NOT NULL,
  `nameOfRecipint` varchar(255) NOT NULL,
  `residentialAddress` text NOT NULL,
  `permanentHomeAdd` text NOT NULL,
  `signature` varchar(255) NOT NULL,
  `signatureDate` datetime NOT NULL,
  `nameOfGuarantor` varchar(255) NOT NULL,
  `guarantorAddress` text NOT NULL,
  `guarantorOccupation` varchar(255) NOT NULL,
  `guarantorSignature` varchar(255) NOT NULL,
  `guarantorSignatureDate` datetime NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

