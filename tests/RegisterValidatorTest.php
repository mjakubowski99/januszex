<?php
require '../app/validators/RegisterValidator.php';
use PHPUnit\Framework\TestCase;

 
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
		
        $this->assertStringContainsString($register->postalCodeValid("22-500"),'1');
        $this->assertStringContainsString($register->postalCodeValid("01-652"),'1');
        $this->assertStringContainsString($register->postalCodeValid("00-950"),'1');
        $this->assertStringContainsString($register->postalCodeValid("03-921"),'1');
        $this->assertStringContainsString($register->postalCodeValid("92-011"),'1');
        $this->assertStringContainsString($register->postalCodeValid("01-001"),'1');
        $this->assertStringContainsString($register->postalCodeValid("00-151"),'1');
        
        
        
        
        $this->assertStringContainsString($register->postalCodeValid("00-500/"),'0');
        $this->assertStringContainsString($register->postalCodeValid("'2-102"),'0');
        $this->assertStringContainsString($register->postalCodeValid("'12-102"),'0');
        $this->assertStringContainsString($register->postalCodeValid("dd-ddd"),'0');
        $this->assertStringContainsString($register->postalCodeValid("d0-123"),'0');
        $this->assertStringContainsString($register->postalCodeValid("005000"),'0');
        $this->assertStringContainsString($register->postalCodeValid("p02-131"),'0');
        $this->assertStringContainsString($register->postalCodeValid("city"),'0');
        $this->assertStringContainsString($register->postalCodeValid("Warsaw"),'0');
        $this->assertStringContainsString($register->postalCodeValid("0"),'0');
        $this->assertStringContainsString($register->postalCodeValid("834"),'0');
        $this->assertStringContainsString($register->postalCodeValid("123123123"),'0');
        $this->assertStringContainsString($register->postalCodeValid("-22500"),'0');
        $this->assertStringContainsString($register->postalCodeValid("20--302"),'0');
        $this->assertStringContainsString($register->postalCodeValid("-10-300"),'0');
        $this->assertStringContainsString($register->postalCodeValid("500-22"),'0');
        $this->assertStringContainsString($register->postalCodeValid("8i-299"),'0');
        $this->assertStringContainsString($register->postalCodeValid("49848945612864986489641896489648564651187451045784078489"),'0');
        $this->assertStringContainsString($register->postalCodeValid("4984894561286498648964189648964856465118745104578407848949848945612864986489641896489648564651187451045784078489498489456128649864896418964896485646511874510457840784894984894561286498648964189648964856465118745104578407848949848945612864986489641896489648564651187451045784078489498489456128649864896418964896485646511874510457840784894984894561286498648964189648964856465118745104578407848949848945612864986489641896489648564651187451045784078489498489456128649864896418964896485646511874510457840784894984894561286498648964189648964856465118745104578407848949848945612864986489641896489648564651187451045784078489498489456128649864896418964896485646511874510457840784894984894561286498648964189648964856465118745104578407848949848945612864986489641896489648564651187451045784078489498489456128649864896418964896485646511874510457840784894984894561286498648964189648964856465118745104578407848949848945612864986489641896489648564651187451045784078489"),'0');
        $this->assertStringContainsString($register->postalCodeValid(""),'0');
        $this->assertStringContainsString($register->postalCodeValid("89*963"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89/982"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89=963"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89+982"),'0');
        $this->assertStringContainsString($register->postalCodeValid("44!898"),'0');
        $this->assertStringContainsString($register->postalCodeValid("22@500"),'0');
        $this->assertStringContainsString($register->postalCodeValid("44#232"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89$963"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89%982"),'0');
        $this->assertStringContainsString($register->postalCodeValid("44^98"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89&963"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89(982"),'0');
        $this->assertStringContainsString($register->postalCodeValid("44)898"),'0');
        $this->assertStringContainsString($register->postalCodeValid("22_500"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89{963"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89[982"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89]963"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89[]982"),'0');
        $this->assertStringContainsString($register->postalCodeValid("44||898"),'0');
        $this->assertStringContainsString($register->postalCodeValid("22:500"),'0');
        $this->assertStringContainsString($register->postalCodeValid("44::232"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89<963"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89,982"),'0');
        $this->assertStringContainsString($register->postalCodeValid("44<<98"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89>>63"),'0');
        $this->assertStringContainsString($register->postalCodeValid("89>982"),'0');
        $this->assertStringContainsString($register->postalCodeValid("44?898"),'0');
        $this->assertStringContainsString($register->postalCodeValid("22~500"),'0');
        $this->assertStringContainsString($register->postalCodeValid("44`898"),'0');
        $this->assertStringContainsString($register->postalCodeValid("44898"),'0');
        $this->assertStringContainsString($register->postalCodeValid("22500"),'0');
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

 
}
