<?php

namespace GameZone;

use PDOStatement;

abstract class DatabaseObject{

    /**
     * @return bool
     */
    abstract protected function primaryKeyIsset(): bool;

    /**
     * @return int|string
     */
    abstract protected function getPrimaryKey();

    /**
     * @param int|string $id
     * @return self
     */
    abstract protected function setPrimaryKey($id): self;

    /**
     * @return array
     */
    abstract protected function getInsertParams(): array;

    /**
     * @return PDOStatement
     */
    abstract protected function prepareUpdate(): PDOStatement;

    /**
     * @return PDOStatement
     */
    abstract protected function prepareInsert(): PDOStatement;

    /**
     * @return self[]
     */
    abstract public static function getAll(): array;

	abstract public function populate(array $data): self;

    protected function update(){
        $this->prepareUpdate()->execute($this->getUpdateParams());
    }

    protected function insert(){
		$this->prepareInsert()->execute($this->getInsertParams());
        $this->setPrimaryKey(DB::getInstance()->lastInsertId());
    }

    /**
     * @return array
     */
    protected function getUpdateParams(): array{
        $params = $this->getInsertParams();
        $params[] = $this->getPrimaryKey();
        return $params;
    }

    public function save(){
        $this->primaryKeyIsset() ? $this->update() : $this->insert();
    }

    abstract public function delete();

	/**
	 * @param int $time
	 * @return string
	 */
	public static function formatTime(int $time):string {
		return date('d.m.Y', $time);
	}

	/**
	 * @param callable $callback
	 * @param array $vars
	 * @return string
	 */
	public static function generateID(callable $callback, array $vars = []):string {
		do{
			$id = uniqid();
		}while($callback($id, $vars));
		return $id;
	}

}