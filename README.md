<img src="https://cdn-images-1.medium.com/max/1200/1*Ih7G_D_hzoskYTHfa-zNmw.png" width="100" title="Build">

# QuickSocket
QuickSocket is a library used for php server client XSS

# Usage

## Example 1

### Server (PHP)
```php
ExecuteJS($user, "alert($time)");
```

### Client (JS)
```javascript
function AlertTime(time) {
  alert(time)
}
```
This example shows how QuickSokets can be used to call js functions on the client from the server over websockets.

## Example 2

### Server (PHP)
```php
if(isset($_SOCKET["name"]) {
  $name = $_SOCKET["name"];
  ExecuteJS($user, "AlertName($name)");
}
```
### Client (HTML)
```html
<form method="SOCKET">
  What is your name?
  <br>
  <input type="text" name="name">
  <input type="submit">
</form>
```

### Client (JS)
```javascript
function AlertName(name) {
  alert(name)
}
```
This example demonstrates usage of the SOCKET form method

### How to start
To launch the Quicksocket just open QuickSocket.php in PHP-CLI and start a normal webserver with PHP-FPM

### DISCLAIMER
QuickSockets should not be used by anyone for anything, yet
