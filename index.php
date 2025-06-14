<?php
    $archivo = 'visitas.json'; if (!file_exists($archivo)) {file_put_contents($archivo,json_encode([]));}
    $visitas = json_decode(file_get_contents($archivo),true);
    if ($_SERVER["REQUEST_METHOD"]==="POST") {
    $nueva_visita = [
        "nombre" => $_POST["nombre"],
        "apellido" => $_POST["apellido"],
        "cedula" => $_POST["cedula"],
        "edad" => $_POST["edad"],
        "motivo" => $_POST["motivo"],
        "fecha_hora" => date("Y-m-dH:i:s"),
        ];

        $visitas[] = $nueva_visita;
        file_put_contents($archivo, json_encode($visitas, JSON_PRETTY_PRINT));
        header("Location:index.php");
        exit();
    }
    // Manuel Abreu 2024-0221
    // Manuel Abreu 2024-0221
?>
</php>
<!DOCTYPE html>
<html lang="es">
    <head> 
        <meta charset=" UTF-8">
        <title> Consultorio Dental - Visitas</title>
        <style>
            body { font-family: 'Times New Roman', Times, serif; padding: 20px;}
            form, table { margin-top:20px;}
            table { border-collapse: collapse; width: 100%;}
            th, td { border: 1px solid #ccc; border-color: black; padding: 8px; text-align: center;}
            th { background-color: rgb(172, 255, 230);}
            input, select { width: 100%; padding: 6px;}
            .form-container { max-width: 500px;}
            button { padding: 10px 20px;}
        </style>
    </head>
    <body>  
        <h1> Registro de Visitas al Consultorio Dental</h1>
        <div class="form-container">
            <h2> Registrar Nueva Visita</h2>
            <form method = "POST">
                <label> Nombre: </label>
                <input type = "text" name = "nombre" required>
                <label> Apellido: </label>
                <input type= "text" name="apellido"required>
                <label> Cédula: </label>
                <input type="text" name="cedula"required>
                <label> Edad: </label>
                <input type="number" name="edad" min="0" required>

                <label> Motivo de la Visita </label>
                <select name="motivo" required>
                    <option vaule="">--Seleccionar--</option>
                    <option value="Limpieza">Limpieza</option>
                    <option value="Caries">Caries</option>
                    <option value="Dolor">Dolor</option>
                    <option value="Chequeo">Chequeo</option>
                </select>

                <button type="submit">Registrar Visita</button>
            </form>    
        </div>
        <h2> Listado de Visitas Registradas</h2>  
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Edad</th>
                <th>Motivo</th>
                <th>Fecha y Hora</th>
        
            </tr> 
                <?php foreach (array_reverse($visitas) as $visita): ?>
                <tr>
                    <td><?=htmlspecialchars($visita["nombre"])?></td>
                    <td><?=htmlspecialchars($visita["apellido"])?></td>
                    <td><?=htmlspecialchars($visita["cedula"])?></td>
                    <td><?=htmlspecialchars($visita["edad"])?></td>
                    <td><?=htmlspecialchars($visita["motivo"])?></td>
                    <td><?= $visita["fecha_hora"]?></td>
                </tr>
            <?php endforeach;?>
        </table>   
    </body>
</html>