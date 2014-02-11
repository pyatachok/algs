<?php

/**
 * Created by mice
 * To change this template use File | Settings | File Templates.
 */

namespace Application\UF;


interface UFInterface {

	/**
	 * Создает массив из N объектов
	 * @param int $N
	 */
	public function __construct( $N);

	/**
	 * Создает связь между $p и $q
	 * @param int $p
	 * @param int $q
	 */
	public function union( $p, $q);

	/**
	 * Проверяет связанность объектов $p и $q
	 * @param int $p
	 * @param int $q
	 * @return mixed
	 */
	public function connected( $p, $q);


	public function find($p);

	public function count();

	/**
	 * @return array
	 */
	public function getIdArray();

}