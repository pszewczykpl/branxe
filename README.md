# O Branxe
Branxe jest oprogramowaniem wspierającym wykonywanie testów manualnych.

# Definiowanie skryptu oraz akcji

```php
use Branxe\Grammar\JQuery\Element as E;

$script = Branxe\Script::create();
$script->insert(function ($driver) {
    $driver->findElementByName('123')->css('1', '2', 3.3);
    $driver->findElementById('123')->click();
    $driver->findElementById('123')->blur();
});
$script->render();
```

# Zakładka
Uruchomienie skryptu na stronie z poziomu zakładki (pasek zakładek), który wykona zdefiniowane przez nas akcje.

Kod do wpisania w URL zakładki:

```javascript
javascript:(function() {
    branxe=document.createElement('script');
    branxe.type='text/javascript';
    branxe.src='http://127.0.0.1:8000/index.php?v=' + Date.now();

    document.getElementsByTagName("head")[0].appendChild(branxe);
})();
```