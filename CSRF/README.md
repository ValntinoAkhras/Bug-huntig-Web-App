# CSRF (Cross-Site Request Forgery)

## First, what is CSRF (Cross-Site Request Forgery)?

**Cross-site request forgery (CSRF):** CSRF is an attack where a malicious website tricks your browser into sending unwanted, authenticated requests to another site where you’re already logged in. 
Because your browser automatically sends cookies, the target website may think **YOU** performed the action. 

## Example of what CSRF can do
If you're logged into a bank, a malicious site could silently submit a form that transfers money unless the bank uses CSRF protection.

---

### Let's know what are the tokens
**Tokens:** are random or cryptographically generated strings used to verify identity or permissions. They are used in authentication systems like JWT, OAuth, and session-based apps.

**But CSRF tokens are different.**

### CSRF Token
A CSRF token is a unique, unpredictable value tied to a user session. It is embedded in forms or requests and must match the token stored on the server. 
If the attacker cannot read the page (because of **Same-Origin Policy**), they cannot steal the token. Thus, their forged request fails. 

**CSRF Token ≠ JWT**
1. **JWT** authenticates **who you are**.
2. **CSRF token** verifies that the **request came from your site**.
3. JWT stored in cookies is still vulnerable to CSRF unless paired with CSRF tokens or SameSite cookies. 

---

### Cookies
**What is a cookie?** Small text files sent from websites and stored on your device that store:
1. Information about your browsing habits.
2. Preferences.
3. Login status.
4. Personalized experiences, such as keeping items in a shopping cart.

***But can also be used by advertisers to track user activity.***

**Why They Matter in CSRF:**
Cookies automatically attach to every request to a domain. This is why CSRF works: Your browser sends your session cookie even when the request came from a malicious site.

**Cookies store:**
* Login session
* Preferences
* Shopping cart
* Tracking info

**But they do NOT protect against CSRF by themselves.**

---

## Another thing: Authorization vs Authentication
1. **Authentication:** Know who you are. Done using:
    * Passwords
    * Session (cookies)
    * JWT
2. **Authorization:** Are you allowed to do this or not? Like:
    * Role
    * Permission

**CSRF tokens are NOT authorization.** They simply ensure the request is legitimate.

---

## Let's see how we can save ourselves from these attacks

```php
<?php // start tag for php code

session_start(); // told the backend to start the user session or user LOCKER 

if (empty($_SESSION['token'])) { 
    // here we make a session token after you login. 
    // a 32 bytes word and it's too hard for any hacker to know it (impossible)
    $_SESSION['token'] = bin2hex(random_bytes(32)); 
}
$token = $_SESSION['token']; // define a new variable [token] to make a copy from the session and add to the html form

if (!empty($_POST['token'])) // we here told the backend if user POST a form that has a token variable, start checking it 
{ 
    // we told the backend to compare two things: the token in the backend and the token coming from the form 
    // we use hash_equals instead of == because it's safe from "timing attacks"
    if (hash_equals($_SESSION['token'], $_POST['token'])) 
    {
        echo "CSRF token verified"; // if the tokens are the same, accept the request 
    } else {
        echo "Nope"; // we reject the request and print NOPE for the user
    }
}
?> // end tag for php code

<form action="0.php" method="POST"> <div>
        <label for="bla">blabla blaaa</label>
        <input name="bla" id="bla" value="bla">
    </div>
    <div>
        <label for="e">euuu?</label>
        <input name="e" id="e" value="euuuuuuu">
    </div>
    <input name="token" id="token" value="<?php echo $token;?>" hidden> 
    <div>
        <button>blablabla</button>
    </div>
</form>
