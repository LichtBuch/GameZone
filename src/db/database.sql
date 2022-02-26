BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "gameCategories" (
	"gameID"	INTEGER NOT NULL,
	"categorieID"	INTEGER NOT NULL,
	PRIMARY KEY("gameID","categorieID"),
	FOREIGN KEY("categorieID") REFERENCES "categories"("categorieID"),
	FOREIGN KEY("gameID") REFERENCES "games"("gameID")
);
CREATE TABLE IF NOT EXISTS "images" (
	"imageName"	TEXT NOT NULL,
	"gameID"	INTEGER NOT NULL,
	PRIMARY KEY("imageName"),
	FOREIGN KEY("gameID") REFERENCES "games"("gameID")
);
CREATE TABLE IF NOT EXISTS "categories" (
	"categorieID"	INTEGER NOT NULL,
	"categoryName"	TEXT NOT NULL UNIQUE,
	PRIMARY KEY("categorieID" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "games" (
	"gameID"	INTEGER NOT NULL,
	"gameName"	TEXT NOT NULL,
	"description"	TEXT NOT NULL,
	"releaseDate"	INTEGER NOT NULL,
	"price"	REAL NOT NULL,
	"review"	INTEGER,
	"wishlisted"	INTEGER NOT NULL,
	"deleted"	INTEGER NOT NULL,
	PRIMARY KEY("gameID" AUTOINCREMENT)
);
CREATE INDEX IF NOT EXISTS "wishlisted" ON "games" (
	"wishlisted"
);
CREATE INDEX IF NOT EXISTS "deletedGames" ON "games" (
	"deleted"
);
CREATE INDEX IF NOT EXISTS "gameImages" ON "images" (
	"gameID"
);
CREATE INDEX IF NOT EXISTS "gameCategoriesIndex" ON "gameCategories" (
	"gameID"
);
CREATE INDEX IF NOT EXISTS "gameNames" ON "games" (
	"gameName"
);
COMMIT;
