    <?php
    ini_set('display_errors', '1');
    session_start();
    mb_internal_encoding("UTF-8");

    #Autoloader
    function autoload($class) {
        if(mb_strpos($class, "Kontroler")===false)
            require("modely/$class.php");
        else
            require("kontrolery/$class.php");
    }
    spl_autoload_register("autoload");

    
    db::pripojMySQL("localhost","root","","eshop");
    //db::pripojMySQL("localhost","czjan-prochazk15","prochy01","czjan-prochazka");

    #Vybrání stránky ke zobrazení (málo času na router)
    if(isset($_GET['strana']))
    {
        $_GET['strana'] .= "Kontroler";
    	$kontroler= new $_GET['strana'];
    }
    else
    	$kontroler = new NabidkaKontroler();

    $kontroler->Proved();
    $kontroler->Zobraz();