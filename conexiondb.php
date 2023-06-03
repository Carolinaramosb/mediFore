<?php
    class modeloBD{
        private $mysql;

        // Función que permite la conexión a la BD
        public function __construct(){
            $this->mysql = new mysqli("localhost", "Carolina", "carolina", "consulta");
            if ($this->mysql->connect_errno){
                echo("Fallo al conectar: " . $this->mysql->connect_error);
            }
        }

        // Función login
        function loginUser($username, $password) {
            $login['exito'] = false;

            $stmt = $this->mysql->prepare("SELECT * FROM usuarios WHERE nombre = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $res = $stmt->get_result();
            
            if($res->num_rows > 0){
                $row = $res->fetch_assoc();
                if ($row['password'] ===$password) {
                    $login['exito'] = true;
                }
            }

            return $login;
        }
        // Función mostrar datos personales del médico
        function getMedico($medico){
            $stmt = $this->mysql->prepare('SELECT * FROM personalMedico WHERE username = ?');
            $stmt->bind_param('s', $medico);
            $stmt->execute();
            
            $res = $stmt->get_result();
            $medico = array('nombre' => "Nombre desconocido", 'apellidos' => "", 'telefono' => "", 
            'numCol' => "", 'direccion' => "", 'especialidad' => "");

            if ($res->num_rows > 0){
                $row = $res->fetch_assoc();
                $medico = array('nombre' => $row['nombre'], 'apellidos' => $row['apellidos'], 
                'telefono' => $row['telefono'], 'numCol' => $row['numCol'], 'direccion' => $row['direccion'],
                'especialidad' => $row['especialidad']);
                
            }

            return $medico;
        }
        
        // Funcion mostrar datos personales pacientes
        function getPaciente($dni){
            $stmt = $this->mysql->prepare('SELECT * FROM personalPacientes WHERE dni = ?');
            $stmt->bind_param('s', $dni);
            $stmt->execute();
            
            $res = $stmt->get_result();
            $paciente = array('nombre' => "Nombre desconocido", 'apellidos' => "", 'compañia' => "", 
            'fechaNaci' => "",'numHistoria' => "", 'dni' => "", 'direccion' => "", 'telefono' => "");

            if ($res->num_rows > 0){
                $row = $res->fetch_assoc();
                $paciente = array('nombre' => $row['nombre'], 'apellidos' => $row['apellidos'], 
                'compañia' => $row['compSeguro'], 'fechaNaci' => $row['fechaNaci'],
                'numHistoria' => $row['numHistoria'], 'dni' => $row['dni'],'direccion' => $row['direccion'], 
                'telefono' => $row['telefono']);
                
            }
            return $paciente;
        }

        //Funcion mostrar paciente según numHistoria
        function getNumHistorias(){
            $stmt = $this->mysql->prepare('SELECT * FROM personalPacientes');
            $stmt->execute();
            
            $res = $stmt->get_result();
            
            return $res;
        }

        //Funcion mostrar revisiones
        function getRevision($dni){
            $stmt = $this->mysql->prepare('SELECT * FROM revision WHERE dni = ?');
            $stmt->bind_param('s', $dni);
            $stmt->execute();
            
            $res = $stmt->get_result();
            $paciente = array('evolucion' => "");

            if ($res->num_rows > 0){
                $row = $res->fetch_assoc();
                $paciente = array('evolucion' => $row['evolucion']);
                
            }
            return $paciente;
        }

        //Funcion mostrar anamnesis
        function getAnamnesis($dni){
            $stmt = $this->mysql->prepare('SELECT * FROM anamnesis WHERE dni = ?');
            $stmt->bind_param('s', $dni);
            $stmt->execute();
            
            $res = $stmt->get_result();
            $paciente = array('antecedentes' => "", 'enfermedad' => "", 'inspeccion' => "", 'cabezaCuello' => "",
            'neurologica' => "", 'aCardiaca' => "", 'aRespiratoria' => "", 'abdomen' => "", 'extremidades' => "",
            'tension' => "", 'frecuencia' => "");

            if ($res->num_rows > 0){
                $row = $res->fetch_assoc();
                $paciente = array('antecedentes' => $row['antecedentes'], 'enfermedad' => $row['enfermedad'],
                'inspeccion' => $row['inspeccion'], 'cabezaCuello' => $row['cabezaCuello'],
                'neurologica' => $row['neurologica'], 'aCardiaca' => $row['aCardiaca'], 'aRespiratoria' => 
                $row['aRespiratoria'], 'abdomen' => $row['abdomen'], 'extremidades' => $row['extremidades'], 
                'tension' => $row['tension'], 'frecuencia' => $row['frecuencia']);
                
            }
            return $paciente;
        }

        //Funcion mostrar anamnesis
        function getMedicacion($dni){
            $stmt = $this->mysql->prepare('SELECT * FROM medicacion WHERE dni = ?');
            $stmt->bind_param('s', $dni);
            $stmt->execute();
            
            $res = $stmt->get_result();
            $paciente = array('complementaria' => "", 'diagnostico' => "", 'dieta' => "", 'medicina' => "",
            'dosis' => "");

            if ($res->num_rows > 0){
                $row = $res->fetch_assoc();
                $paciente = array('complementaria' => $row['complementaria'], 'diagnostico' => $row['diagnostico'],
                'dieta' => $row['dieta'], 'medicina' => $row['medicina'], 'dosis' => $row['dosis']);                
            }
            return $paciente;
        }

        // Función para el registro de un usuario 
        function addPaciente($paciente){
            
            $stmt = $this->mysql->prepare("SELECT * FROM personalPacientes WHERE DNI = ?");
            $stmt->bind_param("s",$paciente['dni']);
            $stmt->execute();
            $res = $stmt->get_result();
            
            $registrado['error'] = false;
            if($res->num_rows > 0){
                $registrado['error'] = true;
                $registrado['descripcion'] = "El paciente ya está registrado en el sistema";
            }
            else{
                $stmt = $this->mysql->prepare("INSERT INTO personalPacientes (nombre, apellidos, compSeguro, 
                fechaNaci, dni, direccion, telefono) VALUES (?,?,?,?,?,?,?);");
                $stmt->bind_param("sssssss", $paciente['nombre'], $paciente['apellidos'],$paciente['compañia'], 
                $paciente['fecha'], $paciente['dni'],$paciente['direccion'],$paciente['telefono']);
                $stmt->execute();

                $stmt = $this->mysql->prepare("INSERT INTO revision (dni, evolucion) VALUES (?,null)");
                $stmt->bind_param("s", $paciente['dni']);
                $stmt->execute();

                $stmt = $this->mysql->prepare("INSERT INTO anamnesis (dni, antecedentes, enfermedad, inspeccion,
                cabezaCuello, neurologica, aCardiaca, aRespiratoria, abdomen, extremidades, tension, frecuencia)
                VALUES (?,null ,null ,null ,null ,null ,null ,null ,null ,null ,null ,null)");
                $stmt->bind_param("s", $paciente['dni']);
                $stmt->execute();

                $stmt = $this->mysql->prepare("INSERT INTO medicacion (dni, complementaria, diagnostico, dieta,
                medicina, dosis) VALUES (?,null, null, null, null, null)");
                $stmt->bind_param("s", $paciente['dni']);
                $stmt->execute();
            }
            return $registrado;
        }

        //Funcion para editar algunos datos personales del paciente
        function editPaciente($paciente) {
            $stmt = $this->mysql->prepare("UPDATE personalPacientes SET compSeguro = ?, direccion = ?, 
            telefono = ?  WHERE dni = ?");
            $stmt->bind_param("ssss" ,$paciente['compañia'],$paciente['direccion'], $paciente['telefono'],
             $paciente['dni']);
            $stmt->execute();
        }

        //Funcion para editar algunos datos personales del medico
        function editMedico($medico){
            $stmt = $this->mysql->prepare("UPDATE personalMedico SET telefono = ? , direccion = ?, 
            especialidad = ? WHERE username = ?");
            $stmt->bind_param("ssss" ,$medico['telefono'],$medico['direccion'], $medico['especialidad'], 
            $medico['username']);
            $stmt->execute();
        }

        //Funcion para aditar o añadir los datos de anamnesis
        function editDatosMedicos($paciente){   
            $stmt = $this->mysql->prepare("UPDATE anamnesis SET antecedentes= ?, enfermedad= ?, inspeccion= ?, 
            cabezaCuello= ?, neurologica= ?, aCardiaca= ?, aRespiratoria= ?, abdomen= ?, extremidades= ?, 
            tension= ?, frecuencia= ? WHERE dni =?");
            $stmt->bind_param(
            "sssssssssdds",$paciente['antecedentes'],$paciente['enfermedad'], $paciente['inspeccion'], 
            $paciente['cabezaCuello'], $paciente['neurologica'], $paciente['aCardiaca'], 
            $paciente['aRespiratoria'], $paciente['abdomen'], $paciente['extremidades'], $paciente['tension'], 
            $paciente['frecuencia'], $paciente['dni']);
            $stmt->execute();
        }
        function editRevision($paciente){   
            $stmt = $this->mysql->prepare("UPDATE revision SET evolucion = ? WHERE dni = ?");
            $stmt->bind_param("ss", $paciente['evolucion'],$paciente['dni']);
            $stmt->execute();
        }

        //Funcion para aditar o añadir los datos de anamnesis
        function editMedicacion($paciente){   
            $stmt = $this->mysql->prepare("UPDATE medicacion SET complementaria= ?, diagnostico= ?, dieta= ?, 
            medicina= ?, dosis= ? WHERE dni =?");
            $stmt->bind_param(
            "sssssss",$paciente['complementaria'],$paciente['diagnostico'], $paciente['dieta'], 
            $paciente['medicina'], $paciente['dosis'], $paciente['dni']);
            $stmt->execute();
        }

        //Funcion para eliminar paciente
        function eliminarPaciente($dni){
            $stmt = $this->mysql->prepare('SELECT * FROM personalPaciente WHERE dni = ?');
            $stmt->bind_param('s', $dni);
            $stmt->execute();
            
            $res = $stmt->get_result();

            if ($res->num_rows > 0){
                $stmt = $this->mysql->prepare('DELETE FROM revision WHERE dni = ?');
                $stmt->bind_param('s', $dni);
                $stmt->execute(); 

                // $stmt = $this->mysql->prepare('DELETE FROM medicacion WHERE dni = ?');
                // $stmt->bind_param('s', $dni);
                // $stmt->execute(); 

                // $stmt = $this->mysql->prepare('DELETE FROM anamnesis WHERE dni = ?');
                // $stmt->bind_param('s', $dni);
                // $stmt->execute(); 

                // $stmt = $this->mysql->prepare('DELETE FROM personalPaciente WHERE dni = ?');
                // $stmt->bind_param('s', $dni);
                // $stmt->execute();             
            }

        }
}