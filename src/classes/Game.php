<?php

namespace GameZone;


use PDOStatement;

class Game extends DatabaseObject{

    public $gameId;
    public $gameName = '';
    /**
     * @var Image[]
     */
    public $images;
    public $description = '';
    /**
     * @var Category[]
     */
    public $categories;
    public $releaseDate;
    public $price;
    public $review;
    public $wishlisted = false;
	public $favored = false;

    /**
	 * @return bool
	 */
	public function isFavored():bool {
		return $this->favored;
	}

	/**
	 * @param bool $favored
	 * @return Game
	 */
	public function setFavored(bool $favored):self {
		$this->favored=$favored;
		return $this;
	}

    /**
     * @param array $data
     * @return self
     */
    public function populate(array $data): DatabaseObject{
        return $this
        ->setGameId((int)$data['gameID'])
        ->setGameName($data['gameName'])
        ->setDescription($data['description'])
        ->setReleaseDate($data['releaseDate'])
        ->setPrice($data['price'])
        ->setReview((int)$data['review'])
        ->setWishlisted((bool)$data['wishlisted'])
        ->setDeleted((bool)$data['deleted']);
    }

    /**
     * Get the value of gameId
     * 
     * @return int
     */ 
    public function getGameId(): int{
        return $this->gameId;
    }

    /**
     * Set the value of gameId
     *
     * @param int $gameId
     * @return  self
     */
    public function setGameId(int $gameId): self{
		if($gameId !== 0) {
			$this->gameId=$gameId;
		}
        return $this;
    }

    /**
     * Get the value of gameName
     * 
     * @return string
     */ 
    public function getGameName(): string{
        return $this->gameName;
    }

    /**
     * Set the value of gameName
     *
     * @param string $gameName
     * @return  self
     */
    public function setGameName(string $gameName): self{
        $this->gameName = $gameName;
        return $this;
    }

    /**
     * Get the value of images
     * 
     * @return Image[]
     */ 
    public function getImages(): array{
        if(!isset($this->images)){
            $this->images = Image::getImagesByGame($this);
			if(empty($this->images)){
				$this->getTwitchImage();
			}
        }
        return $this->images;
    }

    /**
     * @param Image $image
     * @return self
     */
    public function addImage(Image $image): self{
        $this->loadImages()->images[] = $image;
        return $this;
    }

    /**
     * Get the value of description
     * 
     * @return string
     */ 
    public function getDescription(): string{
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param string $description
     * @return  self
     */
    public function setDescription(string $description): self{
        $this->description = $description;
        return $this;
    }

    /**
     * @return Category[]
     */ 
    public function getCategories(): array{
        return $this->loadCategories()->categories;
    }

    /**
     * @param Category $category
     * @return self
     */
    public function addCategory(Category $category): self{
        $this->loadCategories()->categories[] = $category;
        return $this;
    }

	/**
	 * Get the value of releaseDate
	 *
	 * @return int
	 */
    public function getReleaseDate(): int{
        return $this->releaseDate;
    }

    /**
     * Set the value of releaseDate
     *
     * @param int|string $releaseDate
     * @return  self
     */
    public function setReleaseDate($releaseDate): self{
        $this->releaseDate = $this->convertDate($releaseDate);
        return $this;
    }

    /**
     * Get the value of price
     * 
     * @return float
     */ 
    public function getPrice(): float{
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param float|string $price
     * @return  self
     */
    public function setPrice($price): self{
        $this->price = (float) str_replace(',', '.', $price);
        return $this;
    }

    /**
     * Get the value of review
     * 
     * @return int
     */ 
    public function getReview(): int{
        return $this->review;
    }

    /**
     * Set the value of review
     *
     * @param int $review
     * @return  self
     */
    public function setReview(int $review): self{
        $this->review = $review;
        return $this;
    }

    /**
     * Get the value of wishlisted
     * 
     * @return bool
     */ 
    public function isWishlisted(): bool{
        return $this->wishlisted;
    }

    /**
     * Set the value of wishlisted
     *
     * @param bool $wishlisted
     * @return  self
     */
    public function setWishlisted(bool $wishlisted): self{
        $this->wishlisted = $wishlisted;
        return $this;
    }

    /**
     * @return self[]
     */
    public static function getAll(): array{
        $games = [];

        foreach(DB::getInstance()->query('SELECT * FROM games WHERE deleted = 0') as $row){
            $games[] = (new self())->populate($row);
        }

        return $games;
    }

    /**
     * @param int $id
     * @return self
     */
    public static function getGame(int $id): self{
        $game = new self();

        $statement = DB::getInstance()->prepare('SELECT * FROM games WHERE gameID = ? LIMIT 1');
        if($statement->execute([$id]) && $data = $statement->fetch()){
            $game->populate($data);
        }

        return $game;
    }

    /**
     * @param bool $forceReload
     * @return self
     */
    public function loadCategories(bool $forceReload = false): self{
        if(!isset($this->categories) || $forceReload) {
            $this->categories = Category::getCategoriesByGame($this);
        }
        return $this;
    }

    /**
     * @param bool $forceReload
     * @return self
     */
    public function loadImages(bool $forceReload = false): self{
        if(!isset($this->images) || $forceReload){
            $this->images = Image::getImagesByGame($this);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getInsertParams(): array{
        return [
			$this->getReview(),
			$this->getPrice(),
			(int) $this->isFavored(),
            $this->getGameName(),
            $this->getDescription(),
            $this->getReleaseDate(),
			(int) $this->isWishlisted(),
			(int) $this->isDeleted()
        ];
    }

    public function primaryKeyIsset(): bool{
        return isset($this->gameId);
    }

    public function getPrimaryKey(): int{
        return $this->getGameId();
    }

    protected function setPrimaryKey($id): DatabaseObject{
        return $this->setGameId($id);
    }

    protected function prepareUpdate(): PDOStatement{
        return DB::getInstance()->prepare('UPDATE games SET review = ?, price = ?, favored = ?, gameName = ?, description = ?, releaseDate = ?, wishlisted = ?, deleted = ? WHERE gameID = ?');
    }

    protected function prepareInsert(): PDOStatement{
        return DB::getInstance()->prepare('INSERT INTO games (review, price, favored, gameName, description, releaseDate, wishlisted, deleted) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
    }

	/**
	 * @param array $csvArray
	 * @return self
	 */
    public static function importCSV(array $csvArray): self{

		$game = new self();

        $game
			->setGameName($csvArray[0])
			->setDescription($csvArray[1])
			->setReleaseDate($csvArray[2])
			->setPrice($csvArray[3])
			->setReview($csvArray[4])
			->setWishlisted($csvArray[5])
			->setDeleted($csvArray[6])
			->save();

        return $game;
    }

    /**
     * @return string
     */
    public function getTwitchImage(): string{
        $coverURL = TwitchSearch::getInstance()->search($this->getGameName());
		if(!empty($coverURL)){

			$imageName = Image::generateImageName();
			file_put_contents(Image::PATH . $imageName, file_get_contents($coverURL));

			$image = new Image();
			$image
				->setImageName($imageName)
				->setGameID($this->getGameId())
				->save();

			$this->loadImages(true);
		}

		return $imageName ?? $coverURL;
    }

	/**
	 * @return string
	 */
	public function getCategoriesAsString(): string{
		$names = [];

		foreach ($this->getCategories() as $category){
			$names[] = $category->getCategoryName();
		}

		return implode(', ', $names);
	}

	/**
	 * @return string
	 */
	public function getPriceFormatted():string {
		return number_format($this->getPrice(), 2, ',', '');
	}

	/**
	 * @param $date
	 * @return int
	 */
	public function convertDate($date):int {
		$time = strtotime($date);
		if($time !== false){
			return $time;
		}
		return $date;
	}

	/**
	 * @param Game[] $games
	 * @return void
	 */
	public static function getGameIDsWithoutImage(array $games){
		foreach ($games as $game){
			if(empty($game->getImages())){
				$game->getTwitchImage();
			}
		}
	}

	public function exportCSV(){

	}

}