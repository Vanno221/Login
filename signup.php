<?php
	include 'connection.php';
?>
<html>
	<head>
	</head>
	
	<body>
	<br/><br/><br/><br/>
		<form method="POST" action="">
			<table align="center">
					<b><h2 align="center">REGISTRAZIONE</h2></b>
					<br/><br/>
					<tr>
						<td>Nome:<input type="text" name="nome" value=""/></td>
					</tr>
					<tr>
						<td>Cognome:<input type="text" name="cognome" value=""/></td>
					</tr>
					<tr>
						<td>Data di Nascita:<input type="date" name="data" value=""/></td>
					</tr>
					<tr>
						<td>Username:<input type="text" name="username" value=""/></td>
					</tr>
					<tr>
						<td>Password:<input type="text" name="password" value=""/></td>
					</tr>
					<tr>
						<td><input align="center" type="submit" name="invio" value="REGISTRATI"/></td>
					</tr>
					<br>
			</table>
		<form>
		
		<?php 
				if(isset($_POST['username']))
				{
					try
					{
						$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $db, $username, $password);
						$stm = $dbh->prepare("INSERT INTO dati(username,password,nome,cognome,dataNascita,citta,stato) VALUES(:user,:passwd,:nome,:cognome,:dataN,:citta,:stato)");
						$stm->bindValue(':user',$_POST['username']);
						$pw = md5($_POST['password']);
						$stm->bindValue(':passwd',$pw);
						$stm->bindValue(':nome',$_POST['nome']);
						$stm->bindValue(':cognome',$_POST['cognome']);
						$stm->bindValue(':dataN',$_POST['dataNascita']);
						$stm->bindValue(':citta',$_POST['citta']);
						$stm->bindValue(':stato',$_POST['stato']);

						$stm->execute();
						if($stm->errorCode() == 0)
						{
							echo 'Registrazione effettuata con successo';
						}
						else{
							echo 'Errore nella Query';
						}
					}
					catch (PDOException $e) 
					{
						echo 'Errore con la connessione al Database';
					}
			}
			?>
	</body>
	
</html>