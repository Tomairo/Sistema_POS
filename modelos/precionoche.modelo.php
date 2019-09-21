<?php

require_once 'conexion.php';

class ModeloPrecioNoche{

    /* Insertar Precio Noche */
    static public function mdlIngresarPrecioNoche($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(funcion) VALUES (:funcion)");

		$stmt->bindParam(":funcion", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

    /* Mostrar Precio Noche */
    static public function mdlMostrarPrecioNoche($tabla, $item, $valor)
    {
        if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
    }

    /* Eliminar Precio Noche (Actualizar al Precio Día) */
    static public function mdlBorrarPrecioNoche($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
}