<?php

namespace GameZone;

use PDOStatement;

class Image extends DatabaseObject {

    const PATH = __DIR__ . '/../img/';
	const WEB_PATH = '/src/img/';

    public $imageName;
    public $gameID;

	/**
	 * @param array $data
	 * @return DatabaseObject
	 */
    public function populate(array $data): DatabaseObject{
        return $this
            ->setImageName($data['imageName'])
            ->setGameID((int)$data['gameID'])
			->setDeleted((bool)$data['deleted']);
    }

    /**
     * @return string
     */
    public function getImageName(): string{
        return $this->imageName;
    }

    /**
     * @param string $imageName
     * @return self
     */
    public function setImageName(string $imageName): self{
        $this->imageName = $imageName;
        return $this;
    }

    /**
     * @return int
     */
    public function getGameID(): int{
        return $this->gameID;
    }

    /**
     * @param int $gameID
     * @return self
     */
    public function setGameID(int $gameID): self{
        $this->gameID = $gameID;
        return $this;
    }

    /**
     * @param Game $game
     * @return Image[]
     */
    public static function getImagesByGame(Game $game): array{
        $images = [];

        $statement = DB::getInstance()->prepare('SELECT * FROM images WHERE gameID = ? AND deleted = 0');
        if($statement->execute([$game->getGameId()])){
            foreach ($statement->fetchAll() as $row) {
                $images[] = (new self())->populate($row);
            }
        }

        return $images;
    }

	/**
	 * @return array
	 */
    protected function getInsertParams(): array{
        return [
            $this->getImageName(),
			$this->isDeleted(),
            $this->getGameID()
        ];
    }

    /**
     * @return array
     */
    public static function getAll(): array{
        $images = [];

        foreach (DB::getInstance()->query('SELECT * FROM images') as $row){
            $images[] = (new self())->populate($row);
        }

        return $images;
    }

    /**
     * @return bool
     */
    protected function primaryKeyIsset(): bool{
        return isset($this->imageName);
    }

	/**
	 * @return string
	 */
    protected function getPrimaryKey(): string{
        return $this->getImageName();
    }

    /**
     * @param string $id
     * @return DatabaseObject
     */
    protected function setPrimaryKey($id): DatabaseObject{
        return $this->setImageName($id);
    }

    /**
     * @return PDOStatement
     */
    protected function prepareUpdate(): PDOStatement{
        return DB::getInstance()->prepare('UPDATE images SET deleted = ? WHERE imageName = ?');
    }

	/**
	 * @return array
	 */
	protected function getUpdateParams():array {
		return [
			$this->isDeleted(),
			$this->getImageName()
		];
	}

	/**
     * @return PDOStatement
     */
    protected function prepareInsert(): PDOStatement{
        return DB::getInstance()->prepare('INSERT INTO images (imageName, deleted, gameID) VALUES(?, ?, ?)');
    }

	/**
	 * @param string $extension
	 * @return string
	 */
	public static function generateImageName(string $extension = '.jpg'):string {
		$id = DatabaseObject::generateID(
			function($id, $vars){
				return file_exists(Image::PATH . $id . $vars['extension']);
			},
			['extension' => $extension]
		);
		return $id . $extension;
	}

}