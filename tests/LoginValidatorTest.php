<?php declare(strict_types=1);

require __DIR__.'/../autoloader.php';

use PHPUnit\Framework\TestCase;
use app\validators\LoginValidator;

class LoginValidatorTest extends TestCase
{
	protected function setUp(): void
    {
        $login = new LoginValidator();
    }
    
    
    
    public function testfindUserByEmail()
    {
    	$login = new LoginValidator();
    	
    	$this->assertisArray($login->findUserByEmail("test2@wp.pl"));
    	$this->assertisArray($login->findUserByEmail("data@wp.pl"));
    	
    	$this->assertFalse($login->findUserByEmail("notauser@gmail.com"));
    	$this->assertFalse($login->findUserByEmail("notauser@gmaildasa.com"));
    	$this->assertFalse($login->findUserByEmail("notauser@gmai321l.com"));
    }
    
    public function testcheckPasswordValid()
    {
    	$login = new LoginValidator();
    	
    	$this->assertTrue($login->checkPasswordValid("testdlugiehaslo","$2y$10$5ZlkIZM..detIyghsYFlCu4L9PQ/gnS/.4LINjey6ed6sCCSCmHBG"));
    	$this->assertTrue($login->checkPasswordValid("testdlugiehaslo",'$2y$10$Anhlo..dDrKDGlJMjhVq7Ofrp0DunMVJ4f5dcHbzdTDDqwMKiAFZy'));
    	
    	$this->assertFalse($login->checkPasswordValid("testdlugiehaslo1","$2y$10$5ZlkIZM..detIyghsYFlCu4L9PQ/gnS/.4LINjey6ed6sCCSCmHBG"));
    	$this->assertFalse($login->checkPasswordValid("1testdlugiehaslo","$2y$10$5ZlkIZM..detIyghsYFlCu4L9PQ/gnS/.4LINjey6ed6sCCSCmHBG"));
    	$this->assertFalse($login->checkPasswordValid("tostdlugiehaslo",'$2y$10$Anhlo..dDrKDGlJMjhVq7Ofrp0DunMVJ4f5dcHbzdTDDqwMKiAFZy'));
    	$this->assertFalse($login->checkPasswordValid("testdlugiehasl@",'$2y$10$Anhlo..dDrKDGlJMjhVq7Ofrp0DunMVJ4f5dcHbzdTDDqwMKiAFZy'));
    }
    
    public function testvalidate()
    {
    	$login = new LoginValidator();
    	
    	$this->assertEquals($login->validate(['email'=>"data@wp.pl",'password'=>"testdlugiehaslo"]),"Logowanie poprawne");
    	$this->assertEquals($login->validate(['email'=>"test2@wp.pl",'password'=>"testdlugiehaslo"]),"Logowanie poprawne");
    	
		$this->assertEquals($login->validate(['email'=>"notauser@gmail.com",'password'=>"testdlugiehaslo"]),"Niepoprawna nazwa uzytkownika lub hasło");
    	$this->assertEquals($login->validate(['email'=>"notauser@gmaildasa.com",'password'=>""]),"Wypełnij pole hasło");
    	$this->assertEquals($login->validate(['email'=>"",'password'=>"testdlugiehaslo"]),"Wypełnij pole email");
    	$this->assertEquals($login->validate(['email'=>"test2.pl",'password'=>"testdlugiehaslo"]),"Niepoprawna nazwa uzytkownika lub hasło");
    	$this->assertEquals($login->validate(['email'=>"",'password'=>""]),"Wypełnij pole email");
    	$this->assertEquals($login->validate(['email'=>" ",'password'=>" "]),"Niepoprawna nazwa uzytkownika lub hasło");
    }
    
}    
