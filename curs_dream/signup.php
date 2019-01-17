<?php
//se va folosi functie error($message) deoarece singurul elem care variaza este mesajul. functia contine mesajul si exit()

if(!isset($_POST['email'])) {
error("email is required");	
}
//putea fi folosit si 
//if(!isset($_POST['email'])) {
//echo "email is required";	
//exit();
//}
if(!isset($_POST['psw'])) error("password is required.");
		

if(!isset($_POST['psw-repeat'])) {
	error("password repeat is required");	
}
if($_POST['psw']!=$_POST['psw-repeat']){
	error("passwords must match");
}

// validare daca email mai exista si apoi adaugarea infisierul User.txt a noului user

$users = getUsers();
if(in_array($_POST['email'],$users)) error("user already exist");
$line = $_POST['email'].":".$_POST['psw']. PHP_EOL;
file_put_contents("user.txt", $line, FILE_APPEND);//FILE APPEND se pune pt a nu se suprascrie fisierul


	
//crearea unei finctii de extragere a userului si pas din fisierul user.txt
function getUsers(){
//	$contents = file_get_contents(user.txt)
//s-a obtinut o variabila stringg cu tot continutul fisierului. apoi fisierul se sparge in linii apoi fiecare linie se sparge in user si parola.
	//sau
	
	$lines=file("user.txt");
	$users = [];
	foreach($lines as $line){
	list($email,$psw) = (explode(":", trim($line), 2));
	$users[]=$email;
		}
	return $users;
		//prin functia file ia fisierul si il pune sub forma de linii intr-un array si apoi se explodeaza linia dupa separatorul : se obtine un array care pe poz 0 are user iar pe poz 1 are parola. Apoi cu functia list care primeste ca argument 2 variabile prima fiind asociata cu user si a doua parola. apoi se creaza array $users care po poz 0 are primul email samd.
}
	

function error($message){
	echo $message;
	exit();
}