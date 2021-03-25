<?php declare(strict_types=1);

require __DIR__.'/../autoloader.php';

use PHPUnit\Framework\TestCase;
use app\validators\RegisterValidator;


 
class RegisterValidatorTest extends TestCase
{
 
    protected function setUp(): void
    {
        $register = new RegisterValidator();
    }
    
	public function testmailValid()
	{
		$register = new RegisterValidator();
        
        $this->assertIsString($register->mailValid('test@wsp.pl'));
        $this->assertIsString($register->mailValid('example@example.com'));
        $this->assertIsString($register->mailValid('example@example.co.uk'));
        $this->assertIsString($register->mailValid('1e321xample231@example.co.uk'));
        $this->assertIsString($register->mailValid('TesT@TeStExamPle.com'));
        $this->assertIsString($register->mailValid('Test@TestExample.COm'));
        $this->assertIsString($register->mailValid('tTest@TestExample.c0.pl'));
        $this->assertIsString($register->mailValid('_______@example.com'));
        $this->assertIsString($register->mailValid('firstname+lastname@example.com'));
        $this->assertIsString($register->mailValid('firstname.lastname@example.com'));
        $this->assertIsString($register->mailValid('email@[123.123.123.123]'));
        $this->assertIsString($register->mailValid('"email"@example.com'));
        $this->assertIsString($register->mailValid('1234567890@example.com'));
        $this->assertIsString($register->mailValid('email@example-one.com'));
        $this->assertIsString($register->mailValid('email@example.name'));
        $this->assertIsString($register->mailValid('email@example.museum'));
        $this->assertIsString($register->mailValid('email@example.co.jp'));
        $this->assertIsString($register->mailValid('"email"@example.com'));
        $this->assertIsString($register->mailValid('firstname-lastname@example.com'));
        $this->assertIsString($register->mailValid('acvdfertodacvdfertodacvdfertodacvdfertodacvdfertodacvdfertod@outlook.com'));
        $this->assertIsString($register->mailValid(('"`whoami`"@example.com')));
		$this->assertIsString($register->mailValid(("'|1#@i.i"))); // can be a problem 
        
        
        $this->assertFalse($register->mailValid('a@b-.c')); 
        $this->assertFalse($register->mailValid('plainaddress'));
        $this->assertFalse($register->mailValid('#@%^%#$@#$@#.com'));
        $this->assertFalse($register->mailValid('@example.com'));
        $this->assertFalse($register->mailValid('Joe Smith <email@example.com>'));
        $this->assertFalse($register->mailValid('email.example.com'));
        $this->assertFalse($register->mailValid('email@example@example.com'));
        $this->assertFalse($register->mailValid('.email@example.com'));
        $this->assertFalse($register->mailValid('email.@example.com'));
        $this->assertFalse($register->mailValid('email..email@example.com'));
        $this->assertFalse($register->mailValid('あいうえお@example.com'));
        $this->assertFalse($register->mailValid('email@example.com (Joe Smith)'));
        $this->assertFalse($register->mailValid('email@example'));
        $this->assertFalse($register->mailValid('email@-example.com'));
        $this->assertFalse($register->mailValid('email@111.222.333.44444'));
        $this->assertFalse($register->mailValid('email@example..com'));
        $this->assertFalse($register->mailValid('Abc..123@example.com'));
        $this->assertFalse($register->mailValid('”(),:;<>[\]@example.com'));
        $this->assertFalse($register->mailValid('just”not”right@example.com'));
        $this->assertFalse($register->mailValid('this\ is"really"not\allowed@example.com'));
        $this->assertFalse($register->mailValid('email312.@.example...com'));
        $this->assertFalse($register->mailValid('email#example.web'));
        $this->assertFalse($register->mailValid('"email"@(fake)example.com'));
        
        
        
    } 	
    
	public function testlengthValid()
 	{
     	$register = new RegisterValidator();
     
     	$this->assertTrue($register->lengthValid('password',7));
     	$this->assertTrue($register->lengthValid('pass',2));
     	$this->assertTrue($register->lengthValid('903129313210-332981=3131',3));
     	$this->assertTrue($register->lengthValid('IJDASu2783210@@!#@!_#!#)@#',5));
     	$this->assertTrue($register->lengthValid('3fv1321/***',0));
     	$this->assertTrue($register->lengthValid('888@88@99@5225',4));
     	$this->assertTrue($register->lengthValid('903129313210-332981=3131',6));
     	$this->assertTrue($register->lengthValid('IJDASu2783210@@!#@!_#!#)(@#@#',11));
     	$this->assertTrue($register->lengthValid('a$$sds@adsaDF)90009dsa',9));
     	$this->assertTrue($register->lengthValid('D0as::dsa-32==""dsa0das"==312-==OOpa9080-31----adss9dasxxzza',2));
     	$this->assertTrue($register->lengthValid('123456789',8));
     	$this->assertTrue($register->lengthValid('99@88@77$222!',1));
     
     	$this->assertFalse($register->lengthValid('pas',7));
     	$this->assertFalse($register->lengthValid('p',2));
     	$this->assertFalse($register->lengthValid('32',3));
     	$this->assertFalse($register->lengthValid('d',5));
     	$this->assertFalse($register->lengthValid('903129313210-332981=3131',25));
     	$this->assertFalse($register->lengthValid('IJDASu2783210@@!#@!_#!#)@#',51));
     	$this->assertFalse($register->lengthValid('3fv1321/***',22));
     	$this->assertFalse($register->lengthValid('888@88@99@5225',40));
     	$this->assertFalse($register->lengthValid('903129313210-332981=3131',80));
     	$this->assertFalse($register->lengthValid('IJDASu2783210@@!#@!_#!#)(@#@#',38));
     	$this->assertFalse($register->lengthValid('a$$sds@adsaDF)90009dsa',41));
     	$this->assertFalse($register->lengthValid('D0as::dsa-32==""dsa0das"==312-==OOpa9080-31----adss9dasxxzza',92));
     	$this->assertFalse($register->lengthValid('123456789',9));
     	$this->assertFalse($register->lengthValid('99@88@77$222!',16));
     	
 	}
 
	public function testpasswordsAreTheSame()
 	{
     	$register = new RegisterValidator();
     
     	$this->assertTrue($register->passwordsAreTheSame('password','password'));
	    $this->assertTrue($register->passwordsAreTheSame('903129313210-332981=3131','903129313210-332981=3131'));
    	$this->assertTrue($register->passwordsAreTheSame('IJDASu2783210@@!#@!_#!#)@#','IJDASu2783210@@!#@!_#!#)@#'));
    	$this->assertTrue($register->passwordsAreTheSame('pas','pas'));
    	$this->assertTrue($register->passwordsAreTheSame('32','32'));
    	$this->assertTrue($register->passwordsAreTheSame('987982/**/*-*/*','987982/**/*-*/*'));
    	$this->assertTrue($register->passwordsAreTheSame('987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*','987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*987982/**/*-*/*'));
     
     
     
     
    	$this->assertFalse($register->passwordsAreTheSame('903129313210','332981'));
    	$this->assertFalse($register->passwordsAreTheSame('IJDASu2783210','password'));
    	$this->assertFalse($register->passwordsAreTheSame('pas','pas2'));
   	 	$this->assertFalse($register->passwordsAreTheSame('pas','sap'));
 	    $this->assertFalse($register->passwordsAreTheSame('p@s','pas'));
 	    $this->assertFalse($register->passwordsAreTheSame('PAS','pas'));
 	    $this->assertFalse($register->passwordsAreTheSame('90@#!#!313210','90@#!#!313210a'));
 	    $this->assertFalse($register->passwordsAreTheSame('IJDASu2783210','password'));
 	    $this->assertFalse($register->passwordsAreTheSame('pas','pas2'));
 	    $this->assertFalse($register->passwordsAreTheSame('pas','sap'));
 	    $this->assertFalse($register->passwordsAreTheSame('p@s','pas'));
 	    $this->assertFalse($register->passwordsAreTheSame('PAS','pas'));
 	    $this->assertFalse($register->passwordsAreTheSame('PAs','pas'));
 	    $this->assertFalse($register->passwordsAreTheSame('PaS','Pas'));
	}
	
	public function teststringNumeric()
	{
		$register = new RegisterValidator();
		
        $this->assertTrue($register->stringNumeric("25"));
        $this->assertTrue($register->stringNumeric("33"));
        $this->assertTrue($register->stringNumeric("12"));
        $this->assertTrue($register->stringNumeric("1"));
        $this->assertTrue($register->stringNumeric("0"));
        $this->assertTrue($register->stringNumeric("834"));
        $this->assertTrue($register->stringNumeric("512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589512496589551249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658951249658912496589512496589512496589512496589"));
        $this->assertTrue($register->stringNumeric("1.320312"));
        $this->assertTrue($register->stringNumeric("0.321"));
        $this->assertTrue($register->stringNumeric("-8451.312"));
        $this->assertTrue($register->stringNumeric("-9830"));
        $this->assertTrue($register->stringNumeric("22.21"));
        
        
        
        $this->assertFalse($register->stringNumeric("2/8"));
        $this->assertFalse($register->stringNumeric("string"));
        $this->assertFalse($register->stringNumeric("---asdask"));
        $this->assertFalse($register->stringNumeric("-"));
        $this->assertFalse($register->stringNumeric("1dom"));
        $this->assertFalse($register->stringNumeric("pierwszy"));
        $this->assertFalse($register->stringNumeric("1/2"));
        $this->assertFalse($register->stringNumeric("695000-5868"));
        $this->assertFalse($register->stringNumeric("teststring"));
        $this->assertFalse($register->stringNumeric("8+3"));
        $this->assertFalse($register->stringNumeric("8*2"));
        $this->assertFalse($register->stringNumeric("13131`"));
        $this->assertFalse($register->stringNumeric("dasdasda'"));
        $this->assertFalse($register->stringNumeric("1321'"));
        
        
    }
    
    public function testpostalCodeValid()
    {
        $register = new RegisterValidator();
		
        $this->assertEquals($register->postalCodeValid("22-500"),'1');
        $this->assertEquals($register->postalCodeValid("01-652"),'1');
        $this->assertEquals($register->postalCodeValid("00-950"),'1');
        $this->assertEquals($register->postalCodeValid("03-921"),'1');
        $this->assertEquals($register->postalCodeValid("92-011"),'1');
        $this->assertEquals($register->postalCodeValid("01-001"),'1');
        $this->assertEquals($register->postalCodeValid("00-151"),'1');
        
        
        
        
        $this->assertEquals($register->postalCodeValid("00-500/"),'0');
        $this->assertEquals($register->postalCodeValid("'2-102"),'0');
        $this->assertEquals($register->postalCodeValid("'12-102"),'0');
        $this->assertEquals($register->postalCodeValid("dd-ddd"),'0');
        $this->assertEquals($register->postalCodeValid("d0-123"),'0');
        $this->assertEquals($register->postalCodeValid("005000"),'0');
        $this->assertEquals($register->postalCodeValid("p02-131"),'0');
        $this->assertEquals($register->postalCodeValid("city"),'0');
        $this->assertEquals($register->postalCodeValid("Warsaw"),'0');
        $this->assertEquals($register->postalCodeValid("0"),'0');
        $this->assertEquals($register->postalCodeValid("834"),'0');
        $this->assertEquals($register->postalCodeValid("123123123"),'0');
        $this->assertEquals($register->postalCodeValid("-22500"),'0');
        $this->assertEquals($register->postalCodeValid("20--302"),'0');
        $this->assertEquals($register->postalCodeValid("-10-300"),'0');
        $this->assertEquals($register->postalCodeValid("500-22"),'0');
        $this->assertEquals($register->postalCodeValid("8i-299"),'0');
        $this->assertEquals($register->postalCodeValid("49848945612864986489641896489648564651187451045784078489"),'0');
        $this->assertEquals($register->postalCodeValid("4984894561286498648964189648964856465118745104578407848949848945612864986489641896489648564651187451045784078489498489456128649864896418964896485646511874510457840784894984894561286498648964189648964856465118745104578407848949848945612864986489641896489648564651187451045784078489498489456128649864896418964896485646511874510457840784894984894561286498648964189648964856465118745104578407848949848945612864986489641896489648564651187451045784078489498489456128649864896418964896485646511874510457840784894984894561286498648964189648964856465118745104578407848949848945612864986489641896489648564651187451045784078489498489456128649864896418964896485646511874510457840784894984894561286498648964189648964856465118745104578407848949848945612864986489641896489648564651187451045784078489498489456128649864896418964896485646511874510457840784894984894561286498648964189648964856465118745104578407848949848945612864986489641896489648564651187451045784078489"),'0');
        $this->assertEquals($register->postalCodeValid(""),'0');
        $this->assertEquals($register->postalCodeValid("89*963"),'0');
        $this->assertEquals($register->postalCodeValid("89/982"),'0');
        $this->assertEquals($register->postalCodeValid("89=963"),'0');
        $this->assertEquals($register->postalCodeValid("89+982"),'0');
        $this->assertEquals($register->postalCodeValid("44!898"),'0');
        $this->assertEquals($register->postalCodeValid("22@500"),'0');
        $this->assertEquals($register->postalCodeValid("44#232"),'0');
        $this->assertEquals($register->postalCodeValid("89$963"),'0');
        $this->assertEquals($register->postalCodeValid("89%982"),'0');
        $this->assertEquals($register->postalCodeValid("44^98"),'0');
        $this->assertEquals($register->postalCodeValid("89&963"),'0');
        $this->assertEquals($register->postalCodeValid("89(982"),'0');
        $this->assertEquals($register->postalCodeValid("44)898"),'0');
        $this->assertEquals($register->postalCodeValid("22_500"),'0');
        $this->assertEquals($register->postalCodeValid("89{963"),'0');
        $this->assertEquals($register->postalCodeValid("89[982"),'0');
        $this->assertEquals($register->postalCodeValid("89]963"),'0');
        $this->assertEquals($register->postalCodeValid("89[]982"),'0');
        $this->assertEquals($register->postalCodeValid("44||898"),'0');
        $this->assertEquals($register->postalCodeValid("22:500"),'0');
        $this->assertEquals($register->postalCodeValid("44::232"),'0');
        $this->assertEquals($register->postalCodeValid("89<963"),'0');
        $this->assertEquals($register->postalCodeValid("89,982"),'0');
        $this->assertEquals($register->postalCodeValid("44<<98"),'0');
        $this->assertEquals($register->postalCodeValid("89>>63"),'0');
        $this->assertEquals($register->postalCodeValid("89>982"),'0');
        $this->assertEquals($register->postalCodeValid("44?898"),'0');
        $this->assertEquals($register->postalCodeValid("22~500"),'0');
        $this->assertEquals($register->postalCodeValid("44`898"),'0');
        $this->assertEquals($register->postalCodeValid("44898"),'0');
        $this->assertEquals($register->postalCodeValid("22500"),'0');
        $this->assertEquals($register->postalCodeValid(""),'0');
        $this->assertEquals($register->postalCodeValid(" "),'0');
        $this->assertEquals($register->postalCodeValid("	"),'0');
    }
    
    public function testfieldsAreEmpty()
    {
    	$register = new RegisterValidator();
    	
		$this->assertTrue($register->fieldsAreEmpty(['email','password','password','','surname','city','street','home_number','flat_number','postoffice_name','postoffice_code']));
		$this->assertTrue($register->fieldsAreEmpty(['email','password','password','name','surname','city','street','home_number','','postoffice_name','postoffice_code']));
		$this->assertTrue($register->fieldsAreEmpty(['','password','password','name','surname','city','street','home_number','flat_number','postoffice_name','postoffice_code']));
		$this->assertTrue($register->fieldsAreEmpty(['email','','password','name','','city','street','home_number','flat_number','postoffice_name','postoffice_code']));
		$this->assertTrue($register->fieldsAreEmpty(['email','','','name','surname','city','street','home_number','flat_number','postoffice_name','postoffice_code']));
		$this->assertTrue($register->fieldsAreEmpty(['email','password','password','name','surname','city','','home_number','flat_number','postoffice_name','']));
		$this->assertTrue($register->fieldsAreEmpty(['email','password','password','name','','city','street','home_number','flat_number','','postoffice_code']));
		$this->assertTrue($register->fieldsAreEmpty(['email','password','','name','surname','city','street','','flat_number','postoffice_name','postoffice_code']));
		$this->assertTrue($register->fieldsAreEmpty(['email','password','password','name','','city','street','home_number','flat_number','','postoffice_code']));
		$this->assertTrue($register->fieldsAreEmpty(['email','password','password','name','surname','city','street','home_number','flat_number','postoffice_name','']));
		$this->assertTrue($register->fieldsAreEmpty(['','','password','name','surname','city','street','','flat_number','postoffice_name','postoffice_code']));
		$this->assertTrue($register->fieldsAreEmpty(['email','password','password','name','surname','city','street','','flat_number','postoffice_name','postoffice_code']));
		$this->assertTrue($register->fieldsAreEmpty(['email','password','','name','surname','city','street','home_number','flat_number','','postoffice_code']));
		$this->assertTrue($register->fieldsAreEmpty(['','password','password','name','surname','city','street','home_number','flat_number','postoffice_name','postoffice_code']));
		$this->assertTrue($register->fieldsAreEmpty(['','password','','name','','city','street','home_number','','postoffice_name','postoffice_code']));
		$this->assertTrue($register->fieldsAreEmpty(['email','password','password','name','','city','street','','flat_number','postoffice_name','']));
		$this->assertTrue($register->fieldsAreEmpty(['','','','name','surname','city','street','home_number','','postoffice_name','postoffice_code']));
		$this->assertTrue($register->fieldsAreEmpty(['','','','','','','','','','','']));
		$this->assertTrue($register->fieldsAreEmpty(['email','','','','','','','','','','']));
		$this->assertTrue($register->fieldsAreEmpty(['','','','name','surname','city','street','home_number','','','']));
		
		$this->assertFalse($register->fieldsAreEmpty(['email','password','password','name','surname','city','street','home_number','flat_number','postoffice_name','postoffice_code']));
		//$this->assertFalse($register->fieldsAreEmpty(['email','password','password','name','surname','city','street','home_number','','postoffice_name','postoffice_code']));
		
		
    }
    
    public function testuserExists()
    {
    	$register = new RegisterValidator();
    	
    	$this->assertTrue($register->userExists("test2@wp.pl"));
    	$this->assertTrue($register->userExists("data@wp.pl"));
    	
    	$this->assertFalse($register->userExists("a@wp.pl"));
    	$this->assertFalse($register->userExists(""));
    	$this->assertFalse($register->userExists(" "));
    	$this->assertFalse($register->userExists("''"));
    	
    	
    	
    }
    
    public function testvalidate()
    {
    	$register = new RegisterValidator();
    	
    	$this->assertTrue($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "dsadasdasdas", 'confirm'=>"dsadasdasdas",'name'=>"Imie",'surname'=>"Nazwisko",'city'=>"Miasto",'street'=>"Ulica",'home_number'=>"1",'flat_number'=>"2",'postoffice_name'=>"Warszawa",'postoffice_code'=>"02-015" ]));
    	$this->assertTrue($register->validate([ 'email'=>"test@gmail.com", 'password'=> "*(@0322312DD", 'confirm'=>"*(@0322312DD",'name'=>"Jan",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"Lubelska",'home_number'=>"44",'flat_number'=>"2132",'postoffice_name'=>"Warszawa",'postoffice_code'=>"01-235" ]));
    	#$this->assertTrue($register->validate([ 'email'=>"goodemail@outlook.com", 'password'=> "PsAwrD2213", 'confirm'=>"PsAwrD2213",'name'=>"Jaś",'surname'=>"żźćąśóó",'city'=>"Wioska",'street'=>"",'home_number'=>"14",'flat_number'=>"",'postoffice_name'=>"Wioska",'postoffice_code'=>"32-011" ]));
    	#$this->assertTrue($register->validate([ 'email'=>"00029asa@o22.cww", 'password'=> "PsAwrD2213", 'confirm'=>"PsAwrD2213",'name'=>"Jaś",'surname'=>"żźćąśóó",'city'=>"Warszawa",'street'=>"Lżźóął",'home_number'=>"22",'flat_number'=>"",'postoffice_name'=>"Warszawa",'postoffice_code'=>"02-011" ]));
    	#$this->assertTrue($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"KJan",'surname'=>"żźćąśóó",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"2",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]));
    	$this->assertTrue($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]));
    	$this->assertTrue($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]));
    	#$this->assertTrue($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kowalski",'city'=>"Pierwszy Dolek",'street'=>"",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]));
    	#$this->assertTrue($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kowalski",'city'=>"Warszawa Pierwsza",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]));
    	#$this->assertTrue($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kowalski",'city'=>"Warszawa-Pierwsza",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]));
    	#$this->assertTrue($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan-Pawel",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]));
    	#$this->assertTrue($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan Pawel",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]));
    	#$this->assertTrue($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kowalski-Kowal",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]));
    	#$this->assertTrue($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kowalski Kowal",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]));
    	$this->assertTrue($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"1",'flat_number'=>"2",'postoffice_name'=>"Warszawa-Normalna",'postoffice_code'=>"32-011" ]));
    	$this->assertTrue($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"1",'flat_number'=>"2",'postoffice_name'=>"Warszawa Normalna",'postoffice_code'=>"32-011" ]));
    	#$this->assertTrue($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"3-go Maja",'home_number'=>"1ab",'flat_number'=>"2",'postoffice_name'=>"Warszawa/Normalna",'postoffice_code'=>"32-011" ]));
    	#$this->assertTrue($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"3-go Maja",'home_number'=>"1a",'flat_number'=>"2ab",'postoffice_name'=>"Warszawa/Normalna",'postoffice_code'=>"32-011" ]));
    	
    	
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"KĄŹżćżźóó",'surname'=>"żźćąśóó",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20",'flat_number'=>"5",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"KĄŹżćżźóó",'surname'=>"żźćąśóó",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20",'flat_number'=>"5",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "@@!#@!_#!#)@#", 'confirm'=>"@@!#@!_#!#)@#",'name'=>"",'surname'=>"żźćąśóó",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20",'flat_number'=>"5",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "@@!#@!_#!#)@#", 'confirm'=>"@@!#@!_#!#)@#",'name'=>"GFGa",'surname'=>"",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20",'flat_number'=>"5",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "@@!#@!_#!#)@#", 'confirm'=>"@@!#@!_#!#)@#",'name'=>"GFGa",'surname'=>"kowalski",'city'=>"",'street'=>"Miodowa",'home_number'=>"20",'flat_number'=>"5",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "@@!#@!_#!#)@#", 'confirm'=>"@@!#@!_#!#)@#",'name'=>"GFGa",'surname'=>"kowalski",'city'=>"Warszawa",'street'=>"",'home_number'=>"20",'flat_number'=>"5",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "dsadasdasdas", 'confirm'=>"dsadasdasdas",'name'=>"Imie",'surname'=>"Nazwisko",'city'=>"Miasto",'street'=>"Ulica",'home_number'=>"",'flat_number'=>"2",'postoffice_name'=>"Warszawa",'postoffice_code'=>"02-015" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "dsadasdasdas", 'confirm'=>"dsadasdasdas",'name'=>"Imie",'surname'=>"Nazwisko",'city'=>"Miasto",'street'=>"Ulica",'home_number'=>"1",'flat_number'=>"2",'postoffice_name'=>"",'postoffice_code'=>"02-015" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "dsadasdasdas", 'confirm'=>"dsadasdasdas",'name'=>"Imie",'surname'=>"Nazwisko",'city'=>"Miasto",'street'=>"Ulica",'home_number'=>"1",'flat_number'=>"2",'postoffice_name'=>"Warszawa",'postoffice_code'=>"" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "dsadasdasdas", 'confirm'=>"",'name'=>"",'surname'=>"Nazwisko",'city'=>"",'street'=>"Ulica",'home_number'=>"1",'flat_number'=>"2",'postoffice_name'=>"Warszawa",'postoffice_code'=>"22-111" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "", 'confirm'=>"",'name'=>"Imie",'surname'=>"Nazwisko",'city'=>"Miasto",'street'=>"Ulica",'home_number'=>"1",'flat_number'=>"2",'postoffice_name'=>"",'postoffice_code'=>"02-015" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "66", 'confirm'=>"",'name'=>"Imie",'surname'=>"Nazwisko",'city'=>"Miasto",'street'=>"Ulica",'home_number'=>"1",'flat_number'=>"2",'postoffice_name'=>"",'postoffice_code'=>"02-015" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "6622", 'confirm'=>"",'name'=>"Imie",'surname'=>"Nazwisko",'city'=>"Miasto",'street'=>"Ulica",'home_number'=>"1",'flat_number'=>"2",'postoffice_name'=>"",'postoffice_code'=>"02-015" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "66", 'confirm'=>"",'name'=>"",'surname'=>"Nazwisko",'city'=>"Miasto",'street'=>"Ulica",'home_number'=>"",'flat_number'=>"2",'postoffice_name'=>"",'postoffice_code'=>"02-015" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "66", 'confirm'=>"",'name'=>"",'surname'=>"Nazwisko",'city'=>"Miasto",'street'=>"Ulica",'home_number'=>"1",'flat_number'=>"",'postoffice_name'=>"",'postoffice_code'=>"02-015" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "66", 'confirm'=>"",'name'=>"Imie",'surname'=>"Nazwisko",'city'=>"Miasto",'street'=>"Ulica",'home_number'=>"1",'flat_number'=>"2",'postoffice_name'=>"",'postoffice_code'=>"" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "", 'confirm'=>"",'name'=>"",''=>"",'city'=>"",'street'=>"",'home_number'=>"",'flat_number'=>"",'postoffice_name'=>"",'postoffice_code'=>"" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"", 'password'=> "66432423423", 'confirm'=>"",'name'=>"",'surname'=>"",'city'=>"",'street'=>"",'home_number'=>"",'flat_number'=>"",'postoffice_name'=>"",'postoffice_code'=>"" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"", 'password'=> "", 'confirm'=>"66432423423",'name'=>"",'surname'=>"",'city'=>"",'street'=>"",'home_number'=>"",'flat_number'=>"",'postoffice_name'=>"",'postoffice_code'=>"" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"", 'password'=> "", 'confirm'=>"",'name'=>"Imie",'surname'=>"",'city'=>"",'street'=>"",'home_number'=>"",'flat_number'=>"",'postoffice_name'=>"",'postoffice_code'=>"" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"", 'password'=> "", 'confirm'=>"",'name'=>"",'surname'=>"Nazwisko",'city'=>"",'street'=>"",'home_number'=>"",'flat_number'=>"",'postoffice_name'=>"",'postoffice_code'=>"" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"", 'password'=> "", 'confirm'=>"",'name'=>"",'surname'=>"",'city'=>"Miasto",'street'=>"",'home_number'=>"",'flat_number'=>"",'postoffice_name'=>"",'postoffice_code'=>"" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"", 'password'=> "", 'confirm'=>"",'name'=>"",'surname'=>"",'city'=>"",'street'=>"Ulica",'home_number'=>"",'flat_number'=>"",'postoffice_name'=>"",'postoffice_code'=>"" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"", 'password'=> "", 'confirm'=>"",'name'=>"",'surname'=>"",'city'=>"",'street'=>"",'home_number'=>"1",'flat_number'=>"",'postoffice_name'=>"",'postoffice_code'=>"" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"", 'password'=> "", 'confirm'=>"",'name'=>"",'surname'=>"",'city'=>"",'street'=>"",'home_number'=>"",'flat_number'=>"2",'postoffice_name'=>"",'postoffice_code'=>"" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"", 'password'=> "", 'confirm'=>"",'name'=>"",'surname'=>"",'city'=>"",'street'=>"",'home_number'=>"",'flat_number'=>"",'postoffice_name'=>"Miasto",'postoffice_code'=>"" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"", 'password'=> "", 'confirm'=>"",'name'=>"Imie",'surname'=>"",'city'=>"",'street'=>"",'home_number'=>"",'flat_number'=>"",'postoffice_name'=>"",'postoffice_code'=>"02-015" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>" ", 'password'=> " ", 'confirm'=>" ",'name'=>" ",'surname'=>" ",'city'=>" ",'street'=>" ",'home_number'=>" ",'flat_number'=>" ",'postoffice_name'=>" ",'postoffice_code'=>" " ]),"Podaj prawidłowy adres email");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> " 312321312", 'confirm'=>" 312321312",'name'=>" ",'surname'=>" ",'city'=>" ",'street'=>" ",'home_number'=>" 3",'flat_number'=>"3",'postoffice_name'=>"",'postoffice_code'=>"22-222" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "312 321312", 'confirm'=>" 312 321312",'name'=>" ",'surname'=>" ",'city'=>" ",'street'=>" ",'home_number'=>" 3",'flat_number'=>"3",'postoffice_name'=>"",'postoffice_code'=>"22-222" ]),"Wypelnij wszystkie pola");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> " 312321312", 'confirm'=>"312321312",'name'=>" ",'surname'=>" ",'city'=>" ",'street'=>" ",'home_number'=>" 3",'flat_number'=>"3",'postoffice_name'=>"dsa",'postoffice_code'=>"22-222" ]),"Hasla się nie zgadzaja");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "312321312", 'confirm'=>"312321 312",'name'=>" ",'surname'=>" ",'city'=>" ",'street'=>" ",'home_number'=>" 3",'flat_number'=>"3",'postoffice_name'=>"dsa",'postoffice_code'=>"22-222" ]),"Hasla się nie zgadzaja");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "312321312", 'confirm'=>"312321312",'name'=>" ",'surname'=>" ",'city'=>" ",'street'=>" ",'home_number'=>" trzy",'flat_number'=>"3",'postoffice_name'=>"dsa",'postoffice_code'=>"22-222" ]),"Podales numer domu w zlym formacie");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "312321312", 'confirm'=>"312321312",'name'=>" ",'surname'=>" ",'city'=>" ",'street'=>" ",'home_number'=>" 3",'flat_number'=>"osiem",'postoffice_name'=>"dsa",'postoffice_code'=>"22-222" ]),"Podales numer domu w zlym formacie");
    	$this->assertEquals($register->validate([ 'email'=>"dasdas@wp.pl", 'password'=> "312321312", 'confirm'=>"312321312",'name'=>" ",'surname'=>" ",'city'=>" ",'street'=>" ",'home_number'=>" 3",'flat_number'=>"8",'postoffice_name'=>"dsa",'postoffice_code'=>"22222" ]),"Kod pocztowy jest nieprawidlowy, prawidlowy format to dd-ddd");
    	$this->assertEquals($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"SuperJanek12",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Nie mozesz podawac innych znakow niz litery w imieniu");
    	$this->assertEquals($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Super-Janek",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Nie mozesz podawac innych znakow niz litery w imieniu");
    	$this->assertEquals($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Super-Jan ek",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Nie mozesz podawac innych znakow niz litery w imieniu");
    	$this->assertEquals($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Super- ",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Nie mozesz podawac innych znakow niz litery w imieniu");
    	$this->assertEquals($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"---=",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Nie mozesz podawac innych znakow niz litery w imieniu");
    	$this->assertEquals($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>" ",'surname'=>"Kowalski",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Nie mozesz podawac innych znakow niz litery w imieniu");
    	$this->assertEquals($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kowalski-04",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Nie mozesz podawac innych znakow niz litery w nazwisku");
    	$this->assertEquals($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kow alski",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Nie mozesz podawac innych znakow niz litery w nazwisku");
    	$this->assertEquals($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>" ",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Nie mozesz podawac innych znakow niz litery w nazwisku");
    	$this->assertEquals($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kowalski4",'city'=>"Warszawa",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Nie mozesz podawac innych znakow niz litery w nazwisku");
    	$this->assertEquals($register->validate([ 'email'=>"email@example-one.com", 'password'=> "IJDASu2783210@@!#@!_#!#)@#", 'confirm'=>"IJDASu2783210@@!#@!_#!#)@#",'name'=>"Jan",'surname'=>"Kowalski",'city'=>" ",'street'=>"Miodowa",'home_number'=>"20a",'flat_number'=>"5b",'postoffice_name'=>"Warszawa",'postoffice_code'=>"32-011" ]),"Nie mozesz podawac innych znakow niz litery w nazwie miasta");
    	
    	
    	
    	
    	
    }

 
}
