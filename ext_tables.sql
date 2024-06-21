# Remove after TYPO3 13.2 when all fields are being auto-created

CREATE TABLE tx_chfmedia_domain_model_file_group (
    name varchar(255) DEFAULT '' NOT NULL,
    importOrigin varchar(255) DEFAULT '' NOT NULL
);

# Remove when forge.typo3.org/issues/98322 is fixed to auto-generate these fields

CREATE TABLE tx_chfmedia_domain_model_file_group_tag_label_mm (
	fieldname varchar(63) DEFAULT '' NOT NULL
	tablename varchar(63) DEFAULT '' NOT NULL
);
