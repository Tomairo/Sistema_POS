<?php

require_once 'conexion.php';

class ModeloUsuarios
{
    static public function mdlMostrarUsuario($tabla, $item, $valor)
    {
        if($item != null)
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            /* Utilizamos consultas preparadas para evitar inyecciones sql */

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            /* 
            'binParam()' nos sirve para enlazar parámetros, en este caso enlazamos
            'item' con 'valor' para compararlos. PDO::PARAM_STR es para indicar 
            que el parámetro debe ser un string. 
            */

            $stmt->execute(); /* Ejecutamos la preparación de la sentencia sql */

            return $stmt->fetch(); /* retornamos la preparación de la sentencia sql en un solo ítem */

        }
        else
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute(); /* Ejecutamos la preparación de la sentencia sql */

            return $stmt->fetchAll();

        }

        $stmt->close(); /* cerramos la conexión */

        $stmt = null;

        
    }


    static public function mdlIngresarUsuario($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil, foto) 
                                                           VALUES (:nombre, :usuario, :password, :perfil, :foto)");
        
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

        if($stmt->execute())
        {
            return "ok";
        }
        else
        {
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function mdlEditarUsuario($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password,
                                                                 perfil = :perfil, foto = :foto
                                                                 WHERE usuario = :usuario");
        
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

        if($stmt->execute())
        {
            return "ok";
        }
        else
        {
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    /* Actualizar usuario: este método permite el "acitvar" o "desactivar" a un usuario */
    static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

        if($stmt -> execute())
        {
            return "ok";
        }
        else
        {
            return "error";
        }

        $stmt->close();

        $stmt = null;
    }


    /* Borrar usuario */
    static public function mdlBorrarUsuario($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt -> bindParam(":id", $datos, PDO::PARAM_STR);

        if($stmt -> execute())
        {
            return "ok";
        }
        else
        {
            return "error";
        }

        $stmt->close();

        $stmt = null;

    }
}