#CSRF(Cross-Site-Request-Frogery)


##first what is the CSRF (Cross-Site-Request-Forgery)

**Cross-site request forgery (CSRF):**CSRF is an attack where a malicious website tricks your browser into sending unwanted,
authenticated requests to another site where you’re already logged in.
Because your browser automatically sends cookies, the target website may think you performed the action. 

##Example of what CSRF can do

If you're logged into a bank, a malicious site could silently submit a form that transfers money 
unless the bank uses CSRF protection.

###let's know what is the tokens

**Tokens:**are random or cryptographically generated strings used to verify identity or permissions.
They are used in authentication systems like JWT, OAuth, and session-based apps.

But CSRF tokens are different. 

###CSRF token

A CSRF token is a unique, unpredictable value tied to a user session.
It is embedded in forms or requests and must match the token stored on the server.
If the attacker cannot read the page (because of Same-Origin Policy),
They cannot steal the token.
Thus, their forged request fails. 

CSRF Token ≠ JWT

   **JWT authenticates who you are.**

   **CSRF token verifies that the request came from your site.**

   **JWT stored in cookies is still vulnerable to CSRF unless paired with CSRF tokens or SameSite cookies.** 

###Cookies
**What is cookie:** 

are small text files sent from websites and stored on your device, that store

1-information about your browsing habits.

2-preferences.

3-login status.

4-personalized experiences,such as keeping items in a shopping cart.

***but can also be used by advertisers to track user activity.***

**Why They Matter in CSRF**

Cookies automatically attach to every request to a domain.

This is why CSRF works:
Your browser sends your session cookie even when the request came from a malicious site.

Cookies store:

login session

preferences

shopping cart

tracking info

But they do NOT protect against CSRF by themselves.

## another thing authorization vs authentication

1- authentication: know who are you,done using
	1- passwords
	2- session(cookies)
	3- JWT

2- authorization: are you allowed to do this or not like
	1- role
 	2- permission   
----------------------------------------------------------
##CSRF tokens are NOT authorization

They simply ensure the request is legitimate.

#let's see first how we can save us from this attacks

<?php //start tag for php code

session_start(); //told the backend to start the user session or user LOCKER 

if (empty($_SESSION['token'])) { //if you saved your session that sure from your token's but you don't

    $_SESSION['token'] = bin2hex(random_bytes(32)); //here we make another session token's after you login a 32 bytes word and it's to hard for any hacker to know it or imposipol
}
$token = $_SESSION['token']; //define a new variable [taken] to make a copy from the token's and add to the html forme

if (!empty($_POST['token'])) //we here told the backend if user POST you an forme that have a token variable start checking it 
 { 
    if (hash_equals($_SESSION['token'], $_POST['token'])) //we know told the backend to compersing two thing the token in the backend and the token is coming from the forme (we use hash-eqauls insted == because that safed from "timing attacks")
    {
        echo "CSRF token verified";  //now if the token's is same token are verified and accept the request 
    } else {
        echo "Nope"; //we reject the request and say print NOPE for the user
    }
}
?> //end tag for php code

<form action="0.php" method="POST"> <!--we start our form that send with the http request used POST methode and do excute 0.php 'php code'-->
    <div>
        <label for="bla">blabla blaaa</label>
        <input name="bla" id="bla" value="bla">
    </div>
    <div>
        <label for="e">euuu?</label>
        <input name="e" id="e" value="euuuuuuu">
    </div>
    <input name="token" id="token" value="<?php echo $token;?>" hidden> <!--it's a hidden inbut the user can read it that generated from our code and the same by the hacker because the browser policy -->        
    <div>
        <button>blablabla</button>
    </div>
</form>

##senario on the way to understood that

_you open facebook and a any of web that give you any **cracking service's** or just a
**hacker web** and that poison web have a hidden form like that

<!DOCTYPE html>
<html>
 <head>
    <title>You Won a Prize!</title>
 </head>
  <body onload="document.forms[0].submit()"> <>مبروك! كسبت جايزة، جاري التحميل...</>
    <form action="http://facebook.com/update-profile.php" method="POST" style="display:none;">        
        <input type="hidden" name="email" value="hacker@evil.com">       
    </form>
  </body>
</html>


###okay what is happen in there
if facebook don't use csrf token's just cookie's your email the was be changed,
because your browser had saved your cookies from last login,
every time you open facebook you don't need to login because the browser had saved your cookies,
that's mean any hacker can tricked you browser to make like our bad code going to you profile and change the email.

okay how we can make it safe first you should know the hacker haven't a remote access to your browser that mean hacker just give a
prompt that prompt just tell to do that thing
go to this page and change that things.

###but from your view with csrf 
token's patch that VULN and authorization you before any thing happen
**first:**cookie's sending to the backend with session id and
**second:**server answer you with the tokens in hidden value
and every post method used in http requset that token's are sending to the backend to autorization if that you or not
and to make sure you who open that session
and in the hacker form the hidden tokens not founded when the backend check that post request that mean that form is drop 
and the hacker fails because of the SOP (Same-Origin Policy). It’s a browser security rule that prevents a website (https://www.google.com/search?q=hacker.com)
from reading data inside another website (facebook.com). Since he can’t READ your page, he can’t SEE the hidden token.

w
