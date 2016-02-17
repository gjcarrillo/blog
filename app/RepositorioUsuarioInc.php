<?php 
  
    class RepositorioUsuario
    {
        public static function obtenerTodos($conexion)
        {
            $usuarios = array();
                        
            if (isset($conexion))
            {
                try 
                {
                    include_once 'UsuarioInc.php';
                    
                    $sql = 'SELECT * FROM usuarios';
                    
                    $sentencia = $conexion->prepare($sql);
                    $sentencia->execute();                    
                    $resulrado = $sentencia->fetchAll();
                    
                    if (count($resulrado))
                    {
                        foreach ($resulrado as $fila) 
                        {
                            $usuarios[] = new Usuario(
                             //`Id`, `Nombre`, `Email`, `Password`, `FechaRegistro`, `Activo`       
                                    $fila['Id'],
                                    $fila['Nombre'],
                                    $fila['Email'],
                                    $fila['Password'],
                                    $fila['FechaRegistro'],
                                    $fila['Activo']
                                    
                                    );
                        }
                    }
                    else
                    {
                        print 'NO hay Usuarios......';
                    }
                } 
                catch (PDOException $ex) 
                {
                    print 'ERROR: ' .$ex->getMessage();
                }
            }
            
            return $usuarios;
        }
        
        public static function obtenerNumeroUsuarios($conexion)
        {
            $totalUsuarios= null;
            
            if (isset($conexion))
            {
                try 
                {
                    $sql = "select count(*) as total from usuarios";
                    
                    $sentencia = $conexion->prepare($sql);
                    $sentencia-> execute();
                    $resultado = $sentencia->fetch();
                    
                    $totalUsuarios = $resultado['total'];
                } 
                catch (PDOException $ex) 
                {
                    print 'ERROR: ' . $ex->getMessage();
                }
            }
            
            return $totalUsuarios;
        }
        
        
        
    }

?>