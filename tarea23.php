<?php

///Creación de una clase sencilla
class Persona {
    private $nombre;
    private $edad;
    private $email;

    public function __construct($nombre, $edad, $email) {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->email = $email;
    }
    public function imprimirDatos() {
        echo "Nombre: " . $this->nombre;
        echo "Edad: " . $this->edad . " años";
        echo "Email: " . $this->email;
    }
}

$persona = new Persona("Juan ", 36, "juan@gmail.com");
$persona->imprimirDatos();

///Herencia

class Empleado extends Persona {
    private $puesto;

    public function setPuesto($puesto) {
        $this->puesto = $puesto;
    }
    public function imprimirDatosEmpleado() {
        $this->imprimirDatos();
        echo "Puesto: " . $this->puesto ;
    }
}

$empleado = new Empleado("pepe grillo", 25, "email@gmail.com");
$empleado->setPuesto("Gerente de conciencia");
$empleado->imprimirDatosEmpleado();

//Polimorfismo e interfaces 1

interface Vehiculo {
    public function acelerar($velocidad);
    public function frenar();
}

class Automovil implements Vehiculo {
    public function acelerar($velocidad) {
        echo "El automóvil acelera a " . $velocidad . " km/h";
    }
    public function frenar() {
        echo "El automóvil frena";
    }
    public function imprimirDatosAutomovil() {
        echo "Este es un automóvil";
    }
}

class Bicicleta implements Vehiculo {
    public function acelerar($velocidad) {
        echo "La bicicleta acelera a " . $velocidad . " km/h";
    }
    public function frenar() {
        echo "La bicicleta frena";
    }
    public function imprimirDatosBicicleta() {
        echo "Esta es una bicicleta";
    }
}

$auto = new Automovil();
$auto->imprimirDatosAutomovil();
$auto->acelerar(100);
$auto->frenar();

$bici = new Bicicleta();
$bici->imprimirDatosBicicleta();
$bici->acelerar(50);
$bici->frenar();

///Polimorfismo e interfaces 2

interface iVehiculo {
    public function acelerar($velocidad);
    public function frenar();
    public function imprimirDatos();
}

class Automovil implements iVehiculo {
    private $marca;
    private $modelo;

    public function __construct($marca, $modelo) {
        $this->marca = $marca;
        $this->modelo = $modelo;
    }

    public function acelerar($velocidad) {
        echo "El automóvil $this->marca $this->modelo acelera a $velocidad km/h\n";
    }

    public function frenar() {
        echo "El automóvil $this->marca $this->modelo frena\n";
    }

    public function imprimirDatos() {
        echo "Automóvil: $this->marca $this->modelo\n";
    }
}

class Bicicleta implements iVehiculo {
    private $tipo;

    public function __construct($tipo) {
        $this->tipo = $tipo;
    }

    public function acelerar($velocidad) {
        echo "La bicicleta $this->tipo acelera a $velocidad km/h\n";
    }

    public function frenar() {
        echo "La bicicleta $this->tipo frena\n";
    }

    public function imprimirDatos() {
        echo "Bicicleta: $this->tipo\n";
    }
}

$auto = new Automóvil("Toyota", "Camry");
$bici = new Bicicleta("Montaña");

$vehiculos = [$auto, $bici];

foreach ($vehiculos as $vehiculo) {
    $vehiculo->imprimirDatos();
    $vehiculo->acelerar(60);
    $vehiculo->frenar();
    echo "\n";
}



//Abstracción y Encapsulamiento 1

class CuentaBancaria {
    private $saldo;
    private $numeroCuenta;

    public function getSaldo() {
        return $this->saldo;
    }

    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    public function getNumeroCuenta() {
        return $this->numeroCuenta;
    }

    public function setNumeroCuenta($numeroCuenta) {
        $this->numeroCuenta = $numeroCuenta;
    }

    public function depositar($monto) {
        $this->saldo += $monto;
    }

    public function retirar($monto) {
        if ($monto <= $this->saldo) {
            $this->saldo -= $monto;
        } else {
            echo "Saldo insuficiente.";
        }
    }
}

$cuenta = new CuentaBancaria();
$cuenta->setSaldo(100000);
$cuenta->setNumeroCuenta("0000000");

echo "Saldo actual: $" . $cuenta->getSaldo();
$cuenta->depositar(500);
echo "Saldo después del depósito: $" . $cuenta->getSaldo();
$cuenta->retirar(500);
echo "Saldo después del retiro: $" . $cuenta->getSaldo() ;

//Abstracción y Encapsulamiento 2

class CuentaBancaria {
    private $saldo;
    private $numeroCuenta;

    public function __construct($numeroCuenta) {
        $this->numeroCuenta = $numeroCuenta;
        $this->saldo = 0;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function getNumeroCuenta() {
        return $this->numeroCuenta;
    }

    public function setNumeroCuenta($numeroCuenta) {
        $this->numeroCuenta = $numeroCuenta;
    }

    public function depositar($monto) {
        if ($monto > 0) {
            $this->saldo += $monto;
            echo "Depósito de $monto realizado. Nuevo saldo: $" . $this->saldo;
        } else {
            echo "Error: El monto del depósito debe ser mayor que cero.";
        }
    }

    public function retirar($monto) {
        if ($monto > 0 && $this->saldo >= $monto) {
            $this->saldo -= $monto;
            echo "Retiro de $monto realizado. Nuevo saldo: $" . $this->saldo . <br>;
        } else {
            echo "Error: Fondos insuficientes o monto no válido para retiro.";
        }
    }

    public function imprimirDatos() {
        echo "Número de Cuenta: " . $this->numeroCuenta . <br>;
        echo "Saldo Actual: $" . $this->saldo . <br>;
    }
}

$cuenta = new CuentaBancaria("00000000");
$cuenta->depositar(9000);
$cuenta->retirar(500);
$cuenta->imprimirDatos();


///Clase Abstracta

abstract class FiguraGeometrica {
    abstract public function calcularArea();
}

class Cuadrado extends FiguraGeometrica {
    private $lado;

    public function __construct($lado) {
        $this->lado = $lado;
    }

    public function calcularArea() {
        return $this->lado * $this->lado;
    }
}

class Triangulo extends FiguraGeometrica {
    private $base;
    private $altura;

    public function __construct($base, $altura) {
        $this->base = $base;
        $this->altura = $altura;
    }

    public function calcularArea() {
        return (0.5 * $this->base * $this->altura);
    }
}

$cuadrado = new Cuadrado(5);
echo "Área del cuadrado: " . $cuadrado->calcularArea(). <br> ;

$triangulo = new Triangulo(4, 6);
echo "Área del triángulo: " . $triangulo->calcularArea(). <br> ;


///Clase Singleton

class ConexionDB {
    private static $instancia = null;
    private $conexion;

    private function __construct() {
        $this->conexion = new PDO("mysql:host=localhost;dbname=base-de-datos-23", "root", "");
    }

    public static function getConexion() {
        if (!self::$instancia) {
            self::$instancia = new ConexionDB();
        }
        return self::$instancia->conexion;
    }
    public function getConexion() { //obtener conexion
        return $this->conexion;
}

$conexion = ConexionDB::getConexion();



///Clase Factory
class Mascota {
    protected $nombre;
    protected $edad;

    public function __construct($nombre, $edad) {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }
}

class Perro extends Mascota {
    private $raza;
    public function __construct($nombre, $edad, $raza) {
        parent:: __construct($nombre, $edad);
        $this->raza = $raza;
    }
}

class Gato extends Mascota {
    private $pelaje;
    public function __construct($nombre, $edad, $pelaje) {
        parent::__construct($nombre, $edad);
        $this->pelaje = $pelaje;
    }
}

class MascotaFactory {
    public static function crearMascota($especie, $nombre, $edad, $raza_o_pelaje) {
        if ($especie === "perro") {
            return new Perro($nombre, $edad, $raza_o_pelaje);
        } elseif ($especie === "gato") {
            return new Gato($nombre, $edad, $raza_o_pelaje);
        } else {
            return null;
        }
    }
}

$miPerro = MascotaFactory::crearMascota("perro", "perrito", 3, "golden");
$miGato = MascotaFactory::crearMascota("gato", "gatito mimoso", 2, "miley");



///Clase Trait

trait Color {
    private $color;

    public function setColor($color) {
        $this->color = $color;
    }

    public function getColor() {
        return $this->color;
    }

    public function imprimirDatos() {
        echo "Color: " . $this->color;
    }
}

class Automovil {
    use Color;
    public function imprimirDatosAutomovil() {
        echo "Este automóvil tiene el color: " . $this->getColor();
    }
}

class Bicicleta {
    use Color;
    public function imprimirDatosBicicleta() {
        echo "Esta bicicleta tiene el color: " . $this->getColor();
    }
}

$auto = new Automovil();
$auto->setColor("Rojo");
$auto->imprimirDatosAutomovil();

$bici = new Bicicleta();
$bici->setColor("Verde");
$bici->imprimirDatosBicicleta();





?>