# Remove after TYPO3 13.2 when all fields are being auto-created

CREATE TABLE tx_chfmedia_domain_model_file_group (
    name varchar(255) DEFAULT '' NOT NULL,
    importOrigin varchar(255) DEFAULT '' NOT NULL
);
