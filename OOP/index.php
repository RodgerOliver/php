<?php

	// define a class
	class User {
		// constructor
		// called when the class is instantiated
		public function __construct() {
			echo "Constructor called.<br>";
		}

		// propriety
		public $id;
		public $username;
		public $email;
		public $password;
		public $admin = false; // set a default value

		// method
		public function register() {
			echo "User registered!";
		}
		public function login($username, $password) {
			$this->authenticate($username, $password);
			echo "<br>";
			echo "$username is now logged in!";
		}
		public function authenticate($username, $password) {
			echo "$username is authenticated.";
		}
		public function isAdmin() {
			if($this->admin) {
				echo "You are an administrator.";
			} else {
				echo "Sorry, you are not a admin.";
			}
		}

		// destructor
		public function __destruct() {
			//echo "<br>Destructor called.";
		}
	}

	// instantiate a class
	$rodger = new User;
	$rodger->register();
	echo "<br>";
	$rodger->login("Rodger", "123");
	echo "<br>";
	$rodger->isAdmin();
	echo "<br>";
	echo "Set admin to true";
	echo "<br>";
	$rodger->admin = true;
	$rodger->isAdmin();

	echo "<br>";
	echo "<br>";

	class User2 {

		public function __construct($username, $password) {
			$this->username = $username;
			$this->password = $password;
			$user = array("username" => $username, "password" => $password);
			// way to access static proprieties
			// self refers to the class
			self::$group[] = $user;
		}

		// static proprieties and methods
		// these don't need to be instantiated to be called
		public static $group = array();
		public static function retAll() {
			print_r(self::$group);
		}

		// access modifier PRIVATE
		// private means that this can be accessed only inside the class
		private $admin = false;
		// protected means that this can't be accessed by a instance
		// but can by an extended class
		protected $mood = "Sleepy";

		// public means you can access this inside or outside of the class
		public function isAdmin() {
			if($this->admin) {
				echo "You are an administrator.";
			} else {
				echo "Sorry, you are not a admin.";
			}
		}

		public function login() {
			echo "$this->username is now logged in!";
		}

		/* MAGIC METHODS
		public function __set($name, $val) {
			echo "Setting $name to <strong>$val</strong>";
			$this->mood = $val;
		}

		public function __get($name) {
			echo "Getting $name as <strong>$this->mood</strong>";
		}

		public function __isset($name) {
			echo "Is $name set?<br>";
			return isset($his->name);
		}
		*/
	}

	$brad = new User2("Brad", "123");
	$tom = new User2("tom", "456");
	$jerry = new User2("jerry", "789");
	echo "<br>";
	echo $brad->username;
	echo "<br>";
	//echo $brad->admin; OUTPUT: Fatal Error
	//echo $brad->mood; OUTPUT: Fatal Error
	echo $brad->isAdmin();
	echo "<br>";
	echo $brad->login();
	echo "<br>";
	// call static method
	User2::retAll();
	echo "<br>";
	// print static propriety
	var_dump(User2::$group);

	echo "<br>";
	echo "<br>";

	class Person {
		public $name = "Colt";
		public $favColor = "purple";
		private $arms = 2;
		protected $legs = 200;

		public function say($something) {
			echo $something." <em>by $this->name</em>";
		}
		public function retArms() {
			echo $this->arms;
		}
		public function retLegs() {
			echo $this->legs;
		}
		// access the name of class constructor
		public function retClass() {
			return __CLASS__;
		}
	}

	// inherit the proprieties and method from Person
	class Athlete extends Person {
		// overwrite a propriety
		public $name = "Usain";
		public $sport = "running";
		public $arms = 3;
		public $legs = 300;
		// public function retArms() {
		// 	echo $this->arms;
		// }
	}

	$colt = new Person;
	echo $colt->name;
	echo "<br>";
	echo $colt->say("I'm the best teacher of the World!");
	echo "<br>";
	echo $colt->retArms();
	echo "<br>";
	echo $colt->retLegs();
	echo "<br>";
	echo "Class constructor of Colt is ".$colt->retClass();

	echo "<br>";
	echo "<br>";

	$usain = new Athlete;
	echo $usain->name;
	echo "<br>";
	echo $usain->sport;
	echo "<br>";
	// use a extended method
	echo $usain->say("I'm the best runner of the Universe!");
	echo "<br>";
	echo $usain->retArms(); // OUTPUT: 2
	// $arms is private, and it's calling a extended method
	echo "<br>";
	echo $usain->retLegs();
	echo "<br>";
	echo "Class constructor of Usain is ".$usain->retClass();

	echo "<br>";
	echo "<br>";

	// abstract classes are a model for others
	// they cannot be instantiated
	abstract class Animal {
		public $name;
		public $color;
		public function describe() {
			echo $this->name." is ".$this->color;
		}
		// abstract methods cannot contain body
		// abstract methods must be overwritten
		abstract public function makeSound();
	}

	class Duck extends Animal {
		public function describe() {
			echo parent::describe();
		}

		public function makeSound() {
			echo "QUACK!!";
		}
	}

	$duck = new Duck;
	//$animal = new Animal; OUTPUT: Cannot instantiate abstract class Animal
	$duck->name = "Rob";
	$duck->color = "blue";
	$duck->describe();
	echo "<br>";
	$duck->makeSound();


	echo "<br>";
	echo "<br>";

	// include/autoload classes
	spl_autoload_register(function($class_name) {
		include $class_name.".php";
	});

	$foo = new Foo;
	$bar = new Bar;

	$foo->say();
	echo "<br>";
	$bar->sayHi();
	echo "<br>";
	$bar->say();

	// FINAL KEYWORD
	// in front of a class means that this cannot be extended
	final class Me {
		// in front of a method/propriety means that this can't be overwritten
		final public function you() {

		}
	}

?>