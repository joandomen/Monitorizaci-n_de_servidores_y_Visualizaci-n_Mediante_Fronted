$computer =Get-Content env: computernane
#sacamos el porcentaje en, la hora y fecha
$Procesador = Get-Counter -Counter "\Procesador(_totaT)\% de tiempo de procesador".
$valorcpu = $($Procesador | Select-object -EXpandProperty Countersamples).cookedvalue
$nuneric_cpu = [Math]::Round($valorcPu),
$fecna_hora_test = Get-Date

$usomenoria - (Set-Counter '\Memoria\Bytes disponibles').Countersamples.cookedvalue
$totalmemoria = (Get-Cimnstance Win32_PhysicalMenory).Capacity
$porcentajeusoMemoria = 100 - ($usomenoria/$totalMemoria) * 100
$nuneric_ram = [Math]::Round($porcentajeusoMemoria)

#sescribe por pantalla
write-Host "Nombre del equipo:"$computer
#fecha y hora

write-Host "Fecha y Hora"$fecha_hora_test
#valor de CPU

write-Host “Porcentaje de CPU en uso: "$nuneric_cpu "%"
#valor de RAM

write-Host "Porcentaje de RAM en uso:"$nuneric_ram "%"
#Conectar con Mysql al server Tinux
[void][System.Reflection.Assembly]::LoadWithPartialName("Mysql.Data")#1
$Connection = New-Object MySql.Data.MySqlClient.MySqlConnection
$ConnectionString = "server=" + "192.168.1.45" + ";port=3306;uid=" + "usermoni" + ";pwd=" + "usermonitor" +";database="+"monitorizacion"

$Connection.ConnectionString = $ConnectionString #4

$Connection.Open() #5

$QueryInsert_Porcentaje="INSERT INTO monitorizacion.porcentaje (ID_PORCENTAJE,POR_CPU,POR_RAM,NOMBRE_EQUIPO) VALUES (NULL,$nuneric_cpu,$nuneric_ram,'$computer')"#6

$Command = New-Object MySql.Data.MySqlClient.MySqlCommand($QueryInsert_Porcentaje, $Connection)

$DataAdapter = New-Object MySql.Data.MySqlClient.MySqlDataAdapter($Command)

$DataSet = New-Object System.Data.DataSet #7

$RecordCount = $dataAdapter.Fill($dataSet, "data")#8
$DataSet.Tables[0] #9
$Connection.Close()#10
#Joan Domenech Picó 21/22