use `mayorresponds`;
ALTER TABLE votes ADD browser_name VARCHAR(60);
ALTER TABLE votes ADD browser_version VARCHAR(60);
ALTER TABLE votes ADD os_name VARCHAR(60);
ALTER TABLE votes ADD os_version VARCHAR(60);
ALTER TABLE votes ADD ip VARCHAR(60);
