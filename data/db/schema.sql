-- SQLite Schema Definition
CREATE TABLE routes (
	route TEXT PRIMARY KEY,
	classname TEXT NOT NULL,
	args TEXT NULL,
	created DATETIME NOT NULL
);

CREATE INDEX "route" ON "routes" ("route");

INSERT INTO routes (route, classname, args, created) VALUES
("/admin", "Destiny_Admin", "", DATETIME("now")),
("/", "Destiny_Index", "", DATETIME("now"));

CREATE TABLE syslog (
	logid INT PRIMARY KEY AUTO_INCREMENT,
	message TEXT NOT NULL,
	classname TEXT NOT NULL,
	logged DATETIME NOT NULL
);

CREATE INDEX "logid" ON "syslog" ("logid");